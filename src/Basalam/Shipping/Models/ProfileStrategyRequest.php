<?php

namespace Basalam\Shipping\Models;

/**
 * ProfileStrategyRequest model.
 */
class ProfileStrategyRequest implements \JsonSerializable
{
    private ?int $profilesCombineType;
    private ?bool $freeShippingForAllBasket;
    private ?int $vendorId;

    public function __construct(
        ?int $profilesCombineType,
        ?bool $freeShippingForAllBasket,
        ?int $vendorId
    ) {
        $this->profilesCombineType = $profilesCombineType;
        $this->freeShippingForAllBasket = $freeShippingForAllBasket;
        $this->vendorId = $vendorId;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['profiles_combine_type'] ?? null,
            $data['free_shipping_for_all_basket'] ?? null,
            $data['vendor_id'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->profilesCombineType !== null) {
            $result['profiles_combine_type'] = $this->profilesCombineType;
        }
        if ($this->freeShippingForAllBasket !== null) {
            $result['free_shipping_for_all_basket'] = $this->freeShippingForAllBasket;
        }
        if ($this->vendorId !== null) {
            $result['vendor_id'] = $this->vendorId;
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getProfilesCombineType(): ?int
    {
        return $this->profilesCombineType;
    }

    public function getFreeShippingForAllBasket(): ?bool
    {
        return $this->freeShippingForAllBasket;
    }

    public function getVendorId(): ?int
    {
        return $this->vendorId;
    }
}
