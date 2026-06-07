<?php

namespace Basalam\Shipping\Models;

use DateTime;

/**
 * ProfileResponse model.
 */
class ProfileResponse implements \JsonSerializable
{
    private int $id;
    private int $vendorId;
    private string $title;
    private ?array $status;
    private ?bool $isDefault;
    private ?DateTime $createdAt;
    private ?int $productCount;
    private ?string $immediateHintType;

    public function __construct(
        int $id,
        int $vendorId,
        string $title,
        ?array $status,
        ?bool $isDefault,
        ?DateTime $createdAt,
        ?int $productCount,
        ?string $immediateHintType
    ) {
        $this->id = $id;
        $this->vendorId = $vendorId;
        $this->title = $title;
        $this->status = $status;
        $this->isDefault = $isDefault;
        $this->createdAt = $createdAt;
        $this->productCount = $productCount;
        $this->immediateHintType = $immediateHintType;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['vendor_id'],
            $data['title'],
            $data['status'] ?? null,
            $data['is_default'] ?? null,
            isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            $data['product_count'] ?? null,
            $data['immediate_hint_type'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['id'] = $this->id;
        $result['vendor_id'] = $this->vendorId;
        $result['title'] = $this->title;
        $result['status'] = $this->status;
        if ($this->isDefault !== null) {
            $result['is_default'] = $this->isDefault;
        }
        $result['created_at'] = $this->createdAt !== null ? $this->createdAt->format('Y-m-d H:i:s') : null;
        if ($this->productCount !== null) {
            $result['product_count'] = $this->productCount;
        }
        if ($this->immediateHintType !== null) {
            $result['immediate_hint_type'] = $this->immediateHintType;
        }
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

    public function getVendorId(): int
    {
        return $this->vendorId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getStatus(): ?array
    {
        return $this->status;
    }

    public function getIsDefault(): ?bool
    {
        return $this->isDefault;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function getProductCount(): ?int
    {
        return $this->productCount;
    }

    public function getImmediateHintType(): ?string
    {
        return $this->immediateHintType;
    }
}
