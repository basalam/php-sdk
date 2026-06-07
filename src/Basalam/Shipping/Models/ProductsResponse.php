<?php

namespace Basalam\Shipping\Models;

use DateTime;

/**
 * ProductsResponse model.
 */
class ProductsResponse implements \JsonSerializable
{
    private int $id;
    private string $title;
    private int $vendorId;
    private array $status;
    private ?string $imageUrl;
    private ProductProfileResponse $profile;
    private ?DateTime $createdAt;
    private ?DateTime $updatedAt;

    public function __construct(
        int $id,
        string $title,
        int $vendorId,
        array $status,
        ?string $imageUrl,
        ProductProfileResponse $profile,
        ?DateTime $createdAt,
        ?DateTime $updatedAt
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->vendorId = $vendorId;
        $this->status = $status;
        $this->imageUrl = $imageUrl;
        $this->profile = $profile;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['title'],
            $data['vendor_id'],
            $data['status'],
            $data['image_url'] ?? null,
            ProductProfileResponse::fromArray($data['profile']),
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
        $result['profile'] = $this->profile->toArray();
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

    public function getStatus(): array
    {
        return $this->status;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function getProfile(): ProductProfileResponse
    {
        return $this->profile;
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
