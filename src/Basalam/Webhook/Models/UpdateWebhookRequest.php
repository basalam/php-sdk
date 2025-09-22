<?php

namespace Basalam\Webhook\Models;

/**
 * Request model for updating a webhook.
 */
class UpdateWebhookRequest
{
    private ?array $eventIds;
    private ?string $requestHeaders;
    private ?string $requestMethod;
    private ?string $url;
    private ?bool $isActive;

    public function __construct(
        ?array  $eventIds = null,
        ?string $requestHeaders = null,
        ?string $requestMethod = null,
        ?string $url = null,
        ?bool   $isActive = null
    )
    {
        if ($requestMethod !== null && !RequestMethodType::isValid($requestMethod)) {
            throw new \InvalidArgumentException("Invalid request method: {$requestMethod}");
        }

        $this->eventIds = $eventIds;
        $this->requestHeaders = $requestHeaders;
        $this->requestMethod = $requestMethod;
        $this->url = $url;
        $this->isActive = $isActive;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['event_ids'] ?? null,
            $data['request_headers'] ?? null,
            $data['request_method'] ?? null,
            $data['url'] ?? null,
            $data['is_active'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->eventIds !== null) {
            $result['event_ids'] = $this->eventIds;
        }
        if ($this->requestHeaders !== null) {
            $result['request_headers'] = $this->requestHeaders;
        }
        if ($this->requestMethod !== null) {
            $result['request_method'] = $this->requestMethod;
        }
        if ($this->url !== null) {
            $result['url'] = $this->url;
        }
        if ($this->isActive !== null) {
            $result['is_active'] = $this->isActive;
        }

        return $result;
    }

    // Getters

    public function getEventIds(): ?array
    {
        return $this->eventIds;
    }

    public function getRequestHeaders(): ?string
    {
        return $this->requestHeaders;
    }

    public function getRequestMethod(): ?string
    {
        return $this->requestMethod;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }
}