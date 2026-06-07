<?php

namespace Basalam\Shipping\Models;

/**
 * BatchUpdateProfileProductsFreeShippingRulesRequest model.
 */
class BatchUpdateProfileProductsFreeShippingRulesRequest implements \JsonSerializable
{
    private array $productIds;
    private ?string $defaultRule;
    private ?array $neverFreeZoneIds;
    private ?string $zoneOperation;
    private ?int $vendorId;

    public function __construct(
        array $productIds,
        ?string $defaultRule,
        ?array $neverFreeZoneIds,
        ?string $zoneOperation,
        ?int $vendorId
    ) {
        $this->productIds = $productIds;
        $this->defaultRule = $defaultRule;
        $this->neverFreeZoneIds = $neverFreeZoneIds;
        $this->zoneOperation = $zoneOperation;
        $this->vendorId = $vendorId;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['product_ids'],
            $data['default_rule'] ?? null,
            $data['never_free_zone_ids'] ?? null,
            $data['zone_operation'] ?? null,
            $data['vendor_id'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['product_ids'] = $this->productIds;
        if ($this->defaultRule !== null) {
            $result['default_rule'] = $this->defaultRule;
        }
        if ($this->neverFreeZoneIds !== null) {
            $result['never_free_zone_ids'] = $this->neverFreeZoneIds;
        }
        if ($this->zoneOperation !== null) {
            $result['zone_operation'] = $this->zoneOperation;
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

    public function getProductIds(): array
    {
        return $this->productIds;
    }

    public function getDefaultRule(): ?string
    {
        return $this->defaultRule;
    }

    public function getNeverFreeZoneIds(): ?array
    {
        return $this->neverFreeZoneIds;
    }

    public function getZoneOperation(): ?string
    {
        return $this->zoneOperation;
    }

    public function getVendorId(): ?int
    {
        return $this->vendorId;
    }
}
