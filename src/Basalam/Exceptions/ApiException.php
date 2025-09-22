<?php

namespace Basalam\Exceptions;

use Psr\Http\Message\ResponseInterface;

/**
 * Exception raised when an API request fails.
 */
class ApiException extends BasalamException
{
    protected int $statusCode;
    protected ?string $errorCode;  // Renamed to avoid conflict with Exception::$code
    protected ?ResponseInterface $response;
    protected $responseData;  // Can be array, string, or any response type

    /**
     * Initialize the API error.
     *
     * @param string $message
     * @param int $statusCode
     * @param string|int|null $errorCode Optional error code from API
     * @param ResponseInterface|null $response
     * @param mixed $responseData Raw response data
     * @param \Throwable|null $previous
     */
    public function __construct(
        string             $message,
        int                $statusCode,
                           $errorCode = null,
        ?ResponseInterface $response = null,
                           $responseData = null,
        ?\Throwable        $previous = null
    )
    {
        // Format message as "API error {status_code}: {message}"
        $formattedMessage = "API error {$statusCode}: {$message}";
        parent::__construct($formattedMessage, $statusCode, $previous);

        $this->statusCode = $statusCode;
        $this->errorCode = $errorCode !== null ? (string)$errorCode : null;
        $this->response = $response;
        $this->responseData = $responseData;
    }

    /**
     * Get the HTTP status code.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Get the error code from the API response.
     *
     * @return string|null
     */
    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }

    /**
     * Get the HTTP response object.
     *
     * @return ResponseInterface|null
     */
    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    /**
     * Get the raw response data.
     *
     * @return mixed
     */
    public function getResponseData()
    {
        return $this->responseData;
    }
}