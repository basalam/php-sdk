<?php

namespace Basalam\Webhook\Models;

/**
 * Create webhook request model.
 */
class CreateWebhookRequest
{
    private ?int $serviceId;
    private array $eventIds;
    private ?string $requestHeaders;
    private string $requestMethod;
    private string $url;
    private ?bool $isActive;
    private ?bool $registerMe;

    public function __construct(
        array   $eventIds,
        string  $requestMethod,
        string  $url,
        ?int    $serviceId = null,
        ?string $requestHeaders = null,
        ?bool   $isActive = null,
        ?bool   $registerMe = null
    )
    {
        if (!RequestMethodType::isValid($requestMethod)) {
            throw new \InvalidArgumentException("Invalid request method: {$requestMethod}");
        }

        $this->eventIds = $eventIds;
        $this->requestMethod = $requestMethod;
        $this->url = $url;
        $this->serviceId = $serviceId;
        $this->requestHeaders = $requestHeaders;
        $this->isActive = $isActive;
        $this->registerMe = $registerMe;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['event_ids'],
            $data['request_method'],
            $data['url'],
            $data['service_id'] ?? null,
            $data['request_headers'] ?? null,
            $data['is_active'] ?? null,
            $data['register_me'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [
            'event_ids' => $this->eventIds,
            'request_method' => $this->requestMethod,
            'url' => $this->url,
        ];

        if ($this->serviceId !== null) {
            $result['service_id'] = $this->serviceId;
        }
        if ($this->requestHeaders !== null) {
            $result['request_headers'] = $this->requestHeaders;
        }
        if ($this->isActive !== null) {
            $result['is_active'] = $this->isActive;
        }
        if ($this->registerMe !== null) {
            $result['register_me'] = $this->registerMe;
        }

        return $result;
    }

    // Getters

    public function getServiceId(): ?int
    {
        return $this->serviceId;
    }

    public function getEventIds(): array
    {
        return $this->eventIds;
    }

    public function getRequestHeaders(): ?string
    {
        return $this->requestHeaders;
    }

    public function getRequestMethod(): string
    {
        return $this->requestMethod;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function getRegisterMe(): ?bool
    {
        return $this->registerMe;
    }
}