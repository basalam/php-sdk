<?php

namespace Basalam\Webhook\Models;

use DateTime;

/**
 * Webhook resource model.
 */
class WebhookResource implements \JsonSerializable
{
    private int $id;
    private int $serviceId;
    private ?array $events;
    private ?array $requestHeaders;
    private ?string $requestMethod;
    private ?string $url;
    private ?bool $isActive;
    private ?DateTime $createdAt;
    private ?DateTime $updatedAt;

    public function __construct(
        int       $id,
        int       $serviceId,
        ?array    $events = null,
        ?array    $requestHeaders = null,
        ?string   $requestMethod = null,
        ?string   $url = null,
        ?bool     $isActive = null,
        ?DateTime $createdAt = null,
        ?DateTime $updatedAt = null
    )
    {
        $this->id = $id;
        $this->serviceId = $serviceId;
        $this->events = $events;
        $this->requestHeaders = $requestHeaders;
        $this->requestMethod = $requestMethod;
        $this->url = $url;
        $this->isActive = $isActive;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['service_id'],
            $data['events'] ?? null,
            $data['request_headers'] ?? null,
            $data['request_method'] ?? null,
            $data['url'] ?? null,
            $data['is_active'] ?? null,
            isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            isset($data['updated_at']) ? new DateTime($data['updated_at']) : null
        );
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->id,
            'service_id' => $this->serviceId,
        ];

        if ($this->events !== null) {
            $result['events'] = $this->events;
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
        if ($this->createdAt !== null) {
            $result['created_at'] = $this->createdAt->format('Y-m-d H:i:s');
        }
        if ($this->updatedAt !== null) {
            $result['updated_at'] = $this->updatedAt->format('Y-m-d H:i:s');
        }

        return $result;
    }

    // Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getServiceId(): int
    {
        return $this->serviceId;
    }

    public function getEvents(): ?array
    {
        return $this->events;
    }

    public function getRequestHeaders(): ?array
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

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @return array
     */
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}