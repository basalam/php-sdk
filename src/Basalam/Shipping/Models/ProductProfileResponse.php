<?php

namespace Basalam\Shipping\Models;

use DateTime;

/**
 * ProductProfileResponse model.
 */
class ProductProfileResponse implements \JsonSerializable
{
    private int $id;
    private string $title;
    private ?array $status;
    private bool $isDefault;
    private ?DateTime $createdAt;
    private ?DateTime $updatedAt;

    public function __construct(
        int $id,
        string $title,
        ?array $status,
        bool $isDefault,
        ?DateTime $createdAt,
        ?DateTime $updatedAt
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->status = $status;
        $this->isDefault = $isDefault;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['title'],
            $data['status'] ?? null,
            $data['is_default'],
            isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            isset($data['updated_at']) ? new DateTime($data['updated_at']) : null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['id'] = $this->id;
        $result['title'] = $this->title;
        $result['status'] = $this->status;
        $result['is_default'] = $this->isDefault;
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

    public function getStatus(): ?array
    {
        return $this->status;
    }

    public function getIsDefault(): bool
    {
        return $this->isDefault;
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
