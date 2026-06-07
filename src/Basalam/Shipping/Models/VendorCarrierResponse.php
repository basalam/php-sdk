<?php

namespace Basalam\Shipping\Models;

use DateTime;

/**
 * VendorCarrierResponse model.
 */
class VendorCarrierResponse implements \JsonSerializable
{
    private int $id;
    private int $carrierId;
    private string $title;
    private array $status;
    private string $type;
    private ?string $apiUrl;
    private ?array $config;
    private ?string $logoUrl;
    private ?DateTime $createdAt;
    private ?DateTime $updatedAt;

    public function __construct(
        int $id,
        int $carrierId,
        string $title,
        array $status,
        string $type,
        ?string $apiUrl,
        ?array $config,
        ?string $logoUrl,
        ?DateTime $createdAt,
        ?DateTime $updatedAt
    ) {
        $this->id = $id;
        $this->carrierId = $carrierId;
        $this->title = $title;
        $this->status = $status;
        $this->type = $type;
        $this->apiUrl = $apiUrl;
        $this->config = $config;
        $this->logoUrl = $logoUrl;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['carrier_id'],
            $data['title'],
            $data['status'],
            $data['type'],
            $data['api_url'] ?? null,
            $data['config'] ?? null,
            $data['logo_url'] ?? null,
            isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            isset($data['updated_at']) ? new DateTime($data['updated_at']) : null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['id'] = $this->id;
        $result['carrier_id'] = $this->carrierId;
        $result['title'] = $this->title;
        $result['status'] = $this->status;
        $result['type'] = $this->type;
        $result['api_url'] = $this->apiUrl;
        $result['config'] = $this->config;
        $result['logo_url'] = $this->logoUrl;
        $result['created_at'] = $this->createdAt !== null ? $this->createdAt->format('Y-m-d H:i:s') : null;
        $result['updated_at'] = $this->updatedAt !== null ? $this->updatedAt->format('Y-m-d H:i:s') : null;
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCarrierId(): int
    {
        return $this->carrierId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getStatus(): array
    {
        return $this->status;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getApiUrl(): ?string
    {
        return $this->apiUrl;
    }

    public function getConfig(): ?array
    {
        return $this->config;
    }

    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }
}
