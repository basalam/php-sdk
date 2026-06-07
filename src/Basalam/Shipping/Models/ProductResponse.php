<?php

namespace Basalam\Shipping\Models;

use DateTime;

/**
 * ProductResponse model.
 */
class ProductResponse implements \JsonSerializable
{
    private int $id;
    private string $title;
    private int $vendorId;
    private ?array $status;
    private ?string $imageUrl;
    private ?string $defaultShippingRule;
    private ?array $neverFreeZoneIds;
    private ?array $forceFreeZoneIds;
    private ?DateTime $createdAt;
    private ?DateTime $updatedAt;

    public function __construct(
        int $id,
        string $title,
        int $vendorId,
        ?array $status,
        ?string $imageUrl,
        ?string $defaultShippingRule,
        ?array $neverFreeZoneIds,
        ?array $forceFreeZoneIds,
        ?DateTime $createdAt,
        ?DateTime $updatedAt
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->vendorId = $vendorId;
        $this->status = $status;
        $this->imageUrl = $imageUrl;
        $this->defaultShippingRule = $defaultShippingRule;
        $this->neverFreeZoneIds = $neverFreeZoneIds;
        $this->forceFreeZoneIds = $forceFreeZoneIds;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['title'],
            $data['vendor_id'],
            $data['status'] ?? null,
            $data['image_url'] ?? null,
            $data['default_shipping_rule'] ?? null,
            $data['never_free_zone_ids'] ?? null,
            $data['force_free_zone_ids'] ?? null,
            isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            isset($data['updated_at']) ? new DateTime($data['updated_at']) : null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['id'] = $this->id;
        $result['title'] = $this->title;
        $result['vendor_id'] = $this->vendorId;
        $result['status'] = $this->status;
        $result['image_url'] = $this->imageUrl;
        $result['default_shipping_rule'] = $this->defaultShippingRule;
        $result['never_free_zone_ids'] = $this->neverFreeZoneIds;
        $result['force_free_zone_ids'] = $this->forceFreeZoneIds;
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

    public function getVendorId(): int
    {
        return $this->vendorId;
    }

    public function getStatus(): ?array
    {
        return $this->status;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function getDefaultShippingRule(): ?string
    {
        return $this->defaultShippingRule;
    }

    public function getNeverFreeZoneIds(): ?array
    {
        return $this->neverFreeZoneIds;
    }

    public function getForceFreeZoneIds(): ?array
    {
        return $this->forceFreeZoneIds;
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
