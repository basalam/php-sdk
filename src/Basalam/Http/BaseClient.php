<?php

namespace Basalam\Http;

use Basalam\Auth\BaseAuth;
use Basalam\Config\Config;
use Basalam\Exceptions\ApiException;
use Basalam\Exceptions\AuthException;
use Basalam\Exceptions\BasalamException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Base client for making requests to the Basalam API.
 *
 * This class handles HTTP requests, authentication, and error handling.
 * It serves as the foundation for all service-specific clients.
 *
 * This provides the foundation for HTTP communication with Basalam API services.
 */
abstract class BaseClient
{
    protected BaseAuth $auth;
    protected Config $config;
    protected Client $httpClient;
    protected ?string $service;
    protected string $baseUrl;

    /**
     * Initialize the base client.
     *
     * @param BaseAuth $auth Authentication instance
     * @param Config|null $config Configuration instance
     * @param string|null $service Service name (e.g., 'core', 'chat', 'wallet')
     */
    public function __construct(BaseAuth $auth, ?Config $config = null, ?string $service = null)
    {
        $this->auth = $auth;
        $this->config = $config ?? new Config();
        $this->service = $service;

        // Set the base URL for this service
        if ($service) {
            $this->baseUrl = $this->config->getServiceUrl($service);
        } else {
            $this->baseUrl = $this->config->getBaseUrl();
        }

        // Initialize HTTP client with base config
        // Note: We only set User-Agent here, Content-Type will be set per request as needed
        $this->httpClient = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->config->getTimeout(),
            'headers' => $this->config->getHeaders(),
            'http_errors' => false,  // We handle errors manually
            'allow_redirects' => true,
        ]);
    }

    /**
     * Get the base URL.
     *
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Get the service name.
     *
     * @return string|null
     */
    public function getService(): ?string
    {
        return $this->service;
    }

    /**
     * Make a GET request.
     */
    protected function get(
        string $path,
        array  $params = [],
        array  $headers = [],
        bool   $requireAuth = true
    ): array
    {
        $options = [];

        if (!empty($params)) {
            $options['query'] = $params;
        }

        if (!empty($headers)) {
            $options['headers'] = $headers;
        }

        return $this->request('GET', $path, $options, $requireAuth);
    }

    /**
     * Make a request to the API.
     *
     * This is the main request method that all HTTP methods use.
     *
     * @param string $method HTTP method
     * @param string $path API endpoint path
     * @param array $options Guzzle request options
     * @param bool $requireAuth Whether authentication is required
     * @return array Parsed response data
     * @throws BasalamException
     * @throws AuthException
     * @throws ApiException
     */
    protected function request(
        string $method,
        string $path,
        array  $options = [],
        bool   $requireAuth = true
    ): array
    {
        // Build headers: start with config headers, add auth headers if needed, then custom headers
        $requestHeaders = $this->config->getHeaders();

        if ($requireAuth) {
            $authHeaders = $this->auth->getAuthHeaders();
            $requestHeaders = array_merge($requestHeaders, $authHeaders);
        }

        // Merge with any headers provided in options
        if (isset($options['headers'])) {
            $requestHeaders = array_merge($requestHeaders, $options['headers']);
            $options['headers'] = $requestHeaders;
        } else {
            $options['headers'] = $requestHeaders;
        }

        try {
            $response = $this->httpClient->request($method, $path, $options);

            // Check for HTTP errors
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 400) {
                $this->handleHttpError($response);
            }

            return $this->parseResponse($response);
        } catch (GuzzleException $e) {
            // Handle network errors
            throw new BasalamException('Request failed: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Handle HTTP errors and convert them to Basalam exceptions.
     *
     * @param ResponseInterface $response
     * @throws AuthException
     * @throws ApiException
     */
    protected function handleHttpError(ResponseInterface $response): void
    {
        $statusCode = $response->getStatusCode();

        // Debug logging
        try {
            $responseData = json_decode($response->getBody()->getContents(), true);
            if ($responseData) {
                error_log(sprintf(
                    "API Error Response (%d): %s",
                    $statusCode,
                    json_encode($responseData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
                ));
            }
        } catch (\Exception $e) {
            error_log(sprintf("API Error Response (%d): %s", $statusCode, $response->getBody()));
        }

        // Reset body stream for further use
        $response->getBody()->rewind();

        // Parse error details from response first
        $errorMessage = '';
        $errorCode = null;
        $responseData = null;

        try {
            $responseData = json_decode($response->getBody()->getContents(), true);
            $errorMessage = $responseData['message'] ?? $responseData['error'] ?? "HTTP {$statusCode} error";
            $errorCode = $responseData['code'] ?? $statusCode;  // Use status code as fallback
        } catch (\Exception $e) {
            $errorMessage = "HTTP {$statusCode} error";
            $errorCode = $statusCode;
        }

        // Handle 401 authentication errors
        if ($statusCode === 401) {
            throw new AuthException(
                message: "Authentication failed: {$errorMessage}",
                response: $response,
                responseData: $responseData
            );
        }

        // Throw general API exception
        throw new ApiException(
            message: $errorMessage,
            statusCode: $statusCode,
            errorCode: $errorCode,
            response: $response,
            responseData: $responseData
        );
    }

    /**
     * Parse response data and validate with model if provided.
     *
     * @param ResponseInterface $response
     * @return array
     * @throws BasalamException
     */
    protected function parseResponse(ResponseInterface $response): array
    {
        $content = $response->getBody()->getContents();

        // Handle empty responses
        if (empty($content)) {
            return [];
        }

        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new BasalamException('Invalid JSON response: ' . $content);
        }

        // Note: Model validation should be handled by the service clients themselves

        return $data;
    }

    /**
     * Make a POST request.
     */
    protected function post(
        string $path,
        array  $data = [],
        array  $files = [],
        array  $headers = [],
        bool   $requireAuth = true
    ): array
    {
        $options = [];

        if (!empty($files)) {
            // Multipart request for file uploads
            $multipart = [];

            // Add data fields to multipart
            foreach ($data as $key => $value) {
                $multipart[] = [
                    'name' => $key,
                    'contents' => is_array($value) ? json_encode($value) : $value,
                ];
            }

            // Add files to multipart
            foreach ($files as $key => $file) {
                if (isset($file[0]) && is_array($file[0])) {
                    // Multiple files
                    foreach ($file as $f) {
                        $multipart[] = [
                            'name' => $key . '[]',
                            'contents' => isset($f['contents']) ? $f['contents'] : fopen($f['path'], 'r'),
                            'filename' => $f['filename'] ?? basename($f['path'] ?? 'upload.bin'),
                        ];
                    }
                } elseif (isset($file['path']) || isset($file['contents'])) {
                    // Single file (either with path or direct contents)
                    $multipart[] = [
                        'name' => $key,
                        'contents' => isset($file['contents']) ? $file['contents'] : fopen($file['path'], 'r'),
                        'filename' => $file['filename'] ?? (isset($file['path']) ? basename($file['path']) : 'upload.bin'),
                    ];
                }
            }

            $options['multipart'] = $multipart;
        } else {
            // JSON request
            $options['json'] = $data;
        }

        if (!empty($headers)) {
            $options['headers'] = $headers;
        }

        return $this->request('POST', $path, $options, $requireAuth);
    }

    /**
     * Make a PUT request.
     */
    protected function put(
        string $path,
        array  $data = [],
        array  $headers = [],
        bool   $requireAuth = true
    ): array
    {
        $options = [];

        $options['json'] = $data;

        if (!empty($headers)) {
            $options['headers'] = $headers;
        }

        return $this->request('PUT', $path, $options, $requireAuth);
    }

    /**
     * Make a PATCH request.
     */
    protected function patch(
        string $path,
        array  $data = [],
        array  $headers = [],
        bool   $requireAuth = true
    ): array
    {
        $options = [];

        $options['json'] = $data;

        if (!empty($headers)) {
            $options['headers'] = $headers;
        }

        return $this->request('PATCH', $path, $options, $requireAuth);
    }

    /**
     * Make a DELETE request.
     *
     * Note: DELETE supports params, data, and json_data.
     */
    protected function delete(
        string $path,
        array  $params = [],
        array  $data = [],
        array  $headers = [],
        bool   $requireAuth = true
    ): array
    {
        $options = [];

        if (!empty($params)) {
            $options['query'] = $params;
        }

        if (!empty($data)) {
            // DELETE uses JSON when data is provided
            $options['json'] = $data;
        }

        if (!empty($headers)) {
            $options['headers'] = $headers;
        }

        return $this->request('DELETE', $path, $options, $requireAuth);
    }

    /**
     * Build the full URL for a request.
     * This is a helper method for debugging or logging.
     *
     * @param string $path
     * @return string
     */
    protected function buildUrl(string $path): string
    {
        // Remove leading slash if present to avoid double slashes
        $path = ltrim($path, '/');

        // Guzzle handles this automatically with base_uri, but this method
        // is useful for debugging
        return rtrim($this->baseUrl, '/') . '/' . $path;
    }
}