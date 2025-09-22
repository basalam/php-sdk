<?php

namespace Basalam\Config;

use Basalam\Version;

/**
 * Configuration for Basalam API client.
 *
 * This class provides configuration management for the Basalam API client,
 * including environment-specific URLs, service endpoints, and client settings.
 */
class Config
{
    /**
     * Base URLs for different environments
     */
    private const BASE_URLS = [
        Environment::PRODUCTION => 'https://basalam.com',
        Environment::DEVELOPMENT => 'https://basalam.dev',
    ];

    /**
     * Authentication URLs for different environments
     */
    private const AUTH_URLS = [
        Environment::PRODUCTION => [
            'authorize' => 'https://basalam.com/accounts/sso',
            'token' => 'https://auth.basalam.com/oauth/token',
        ],
        Environment::DEVELOPMENT => [
            'authorize' => 'https://basalam.dev/accounts/sso',
            'token' => 'https://auth.basalam.dev/oauth/token',
        ],
    ];
    /**
     * @var array<string, ServiceConfig>
     */
    private static array $serviceConfigs;
    private string $environment;
    private string $apiVersion;
    private float $timeout;
    private string $baseUrl;
    private string $authorizeUrl;
    private string $tokenUrl;
    private string $userAgent;
    private array $serviceUrls;

    /**
     * Initialize the configuration.
     *
     * @param string $environment The environment to use (production or development)
     * @param string $apiVersion The API version to use
     * @param float $timeout Request timeout in seconds
     * @param string|null $userAgent Custom User-Agent string to append to SDK User-Agent
     * @param string|null $customBaseUrl Custom base URL to override environment default
     * @param array|null $customAuthUrls Custom authentication URLs
     * @throws \InvalidArgumentException
     */
    public function __construct(
        string  $environment = Environment::PRODUCTION,
        string  $apiVersion = 'v1',
        float   $timeout = 30.0,
        ?string $userAgent = null,
        ?string $customBaseUrl = null,
        ?array  $customAuthUrls = null
    )
    {
        // Validate and normalize environment
        $this->environment = Environment::normalize($environment);
        $this->apiVersion = $apiVersion;
        $this->timeout = $timeout;

        // Set base URL
        $this->baseUrl = $customBaseUrl ?? self::BASE_URLS[$this->environment];

        // Set auth URLs
        $authEnv = self::AUTH_URLS[$this->environment];
        $this->authorizeUrl = $customAuthUrls['authorize'] ?? $authEnv['authorize'];
        $this->tokenUrl = $customAuthUrls['token'] ?? $authEnv['token'];

        // Initialize service configs if not already done
        $this->initializeServiceConfigs();

        // Initialize service URLs
        $this->serviceUrls = $this->initializeServiceUrls();

        // Generate User-Agent with SDK information
        $this->userAgent = Version::getUserAgent($userAgent);
    }

    /**
     * Initialize service configurations (lazy initialization)
     */
    private function initializeServiceConfigs(): void
    {
        if (!isset(self::$serviceConfigs)) {
            self::$serviceConfigs = [
                'core' => new ServiceConfig(
                    baseUrl: 'https://core.basalam.com',
                    path: '',
                    apiVersion: 'v3'
                ),
                'wallet' => new ServiceConfig(
                    baseUrl: 'https://wallet.basalam.com',
                    path: '',
                    apiVersion: 'v2'
                ),
                'chat' => new ServiceConfig(
                    baseUrl: 'https://conversation.basalam.com',
                    path: '',
                    apiVersion: 'v2'
                ),
                'order' => new ServiceConfig(
                    baseUrl: 'https://order.basalam.com',
                    path: '',
                    apiVersion: 'v2'
                ),
                'order-processing' => new ServiceConfig(
                    baseUrl: 'https://order-processing.basalam.com',
                    path: '',
                    apiVersion: 'v3'
                ),
                'search' => new ServiceConfig(
                    baseUrl: 'https://search.basalam.com',
                    path: 'ai-engine/api',
                    apiVersion: 'v2.0'
                ),
                'upload' => new ServiceConfig(
                    baseUrl: 'https://uploadio.basalam.com',
                    path: '',
                    apiVersion: 'v3'
                ),
                'webhook' => new ServiceConfig(
                    baseUrl: 'https://webhook.basalam.com',
                    path: '',
                    apiVersion: 'v1'
                ),
            ];
        }
    }

    /**
     * Initialize service URLs based on environment.
     *
     * @return array<string, string>
     */
    private function initializeServiceUrls(): array
    {
        $baseUrl = self::BASE_URLS[$this->environment];
        $domain = str_replace('https://', '', $baseUrl);

        $urls = [];
        foreach (self::$serviceConfigs as $service => $config) {
            $urls[$service] = str_replace('basalam.com', $domain, $config->getUrl());
        }

        return $urls;
    }

    /**
     * Get the User-Agent
     *
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * Get the base URL for a service.
     *
     * @param string $service The service name
     * @return string The base URL for the service
     */
    public function getServiceUrl(string $service): string
    {
        return $this->serviceUrls[$service] ?? $this->baseUrl;
    }

    /**
     * Get default headers for API requests.
     *
     * @return array Dictionary of default headers including User-Agent
     */
    public function getHeaders(): array
    {
        return [
            'User-Agent' => $this->userAgent,
        ];
    }

    /**
     * Get the base URL
     *
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Get the authorization URL
     *
     * @return string
     */
    public function getAuthorizeUrl(): string
    {
        return $this->authorizeUrl;
    }

    /**
     * Get the token URL
     *
     * @return string
     */
    public function getTokenUrl(): string
    {
        return $this->tokenUrl;
    }

    /**
     * Get the environment
     *
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * Get the API version
     *
     * @return string
     */
    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    /**
     * Get the timeout
     *
     * @return float
     */
    public function getTimeout(): float
    {
        return $this->timeout;
    }

    /**
     * Get service configuration for a specific service
     *
     * @param string $service
     * @return ServiceConfig|null
     */
    public function getServiceConfig(string $service): ?ServiceConfig
    {
        $this->initializeServiceConfigs();
        return self::$serviceConfigs[$service] ?? null;
    }

    /**
     * Get all service configurations
     *
     * @return array<string, ServiceConfig>
     */
    public function getAllServiceConfigs(): array
    {
        $this->initializeServiceConfigs();
        return self::$serviceConfigs;
    }
}