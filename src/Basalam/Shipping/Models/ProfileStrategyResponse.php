<?php

namespace Basalam\Shipping\Models;

use DateTime;

/**
 * ProfileStrategyResponse model.
 */
class ProfileStrategyResponse implements \JsonSerializable
{
    private int $id;
    private int $vendorId;
    private ?array $profilesCombineType;
    private ?bool $freeShippingForAllBasket;
    private ?DateTime $createdAt;
    private ?DateTime $updatedAt;

    public function __construct(
        int $id,
        int $vendorId,
        ?array $profilesCombineType,
        ?bool $freeShippingForAllBasket,
        ?DateTime $createdAt,
        ?DateTime $updatedAt
    ) {
        $this->id = $id;
        $this->vendorId = $vendorId;
        $this->profilesCombineType = $profilesCombineType;
        $this->freeShippingForAllBasket = $freeShippingForAllBasket;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['vendor_id'],
            $data['profiles_combine_type'] ?? null,
            $data['free_shipping_for_all_basket'] ?? null,
            isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            isset($data['updated_at']) ? new DateTime($data['updated_at']) : null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['id'] = $this->id;
        $result['vendor_id'] = $this->vendorId;
        if ($this->profilesCombineType !== null) {
            $result['profiles_combine_type'] = $this->profilesCombineType;
        }
        if ($this->freeShippingForAllBasket !== null) {
            $result['free_shipping_for_all_basket'] = $this->freeShippingForAllBasket;
        }
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

    public function getVendorId(): int
    {
        return $this->vendorId;
    }

    public function getProfilesCombineType(): ?array
    {
        return $this->profilesCombineType;
    }

    public function getFreeShippingForAllBasket(): ?bool
    {
        return $this->freeShippingForAllBasket;
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
