<?php

namespace Basalam\Shipping\Models;

/**
 * CreateCarrierRatesRequest model.
 */
class CreateCarrierRatesRequest implements \JsonSerializable
{
    private array $vendorCarrierIds;

    public function __construct(
        array $vendorCarrierIds
    ) {
        $this->vendorCarrierIds = $vendorCarrierIds;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['vendor_carrier_ids'] ?? []
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['vendor_carrier_ids'] = $this->vendorCarrierIds;
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getVendorCarrierIds(): array
    {
        return $this->vendorCarrierIds;
    }
}
