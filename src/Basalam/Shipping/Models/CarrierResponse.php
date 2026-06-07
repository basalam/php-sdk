<?php

namespace Basalam\Shipping\Models;

use DateTime;

/**
 * CarrierResponse model.
 */
class CarrierResponse implements \JsonSerializable
{
    private int $id;
    private string $title;
    private string $type;
    private ?array $status;
    private ?array $config;
    private ?string $logoUrl;
    private ?DateTime $createdAt;
    private ?DateTime $updatedAt;

    public function __construct(
        int $id,
        string $title,
        string $type,
        ?array $status,
        ?array $config,
        ?string $logoUrl,
        ?DateTime $createdAt,
        ?DateTime $updatedAt
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->type = $type;
        $this->status = $status;
        $this->config = $config;
        $this->logoUrl = $logoUrl;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['title'],
            $data['type'],
            $data['status'] ?? null,
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
        $result['title'] = $this->title;
        $result['type'] = $this->type;
        $result['status'] = $this->status;
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

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getStatus(): ?array
    {
        return $this->status;
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
