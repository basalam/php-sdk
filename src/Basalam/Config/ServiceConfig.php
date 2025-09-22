<?php

namespace Basalam\Config;

/**
 * Configuration for a specific service.
 */
class ServiceConfig
{
    private string $baseUrl;
    private string $apiVersion;
    private string $path;

    public function __construct(
        string $baseUrl,
        string $apiVersion = 'v1',
        string $path = ''
    )
    {
        $this->baseUrl = $baseUrl;
        $this->apiVersion = $apiVersion;
        $this->path = $path;
    }

    /**
     * Create from array (for backward compatibility)
     *
     * @param array $config
     * @return self
     */
    public static function fromArray(array $config): self
    {
        return new self(
            $config['base_url'],
            $config['api_version'] ?? 'v1',
            $config['path'] ?? ''
        );
    }

    /**
     * Get the full service URL.
     *
     * @return string
     */
    public function getUrl(): string
    {
        $parts = [rtrim($this->baseUrl, '/')];

        if (trim($this->path, '/')) {
            $parts[] = trim($this->path, '/');
        }

        if (trim($this->apiVersion, '/')) {
            $parts[] = trim($this->apiVersion, '/');
        }

        return implode('/', $parts);
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
     * Get the API version
     *
     * @return string
     */
    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    /**
     * Get the path
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Convert to array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'base_url' => $this->baseUrl,
            'api_version' => $this->apiVersion,
            'path' => $this->path,
        ];
    }
}