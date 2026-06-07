<?php

namespace Basalam\Shipping\Models;

/**
 * CreateCarrierRateRequest model.
 */
class CreateCarrierRateRequest implements \JsonSerializable
{
    private ?bool $auto;
    private int $vendorCarrierId;
    private ?int $baseCost;
    private ?int $additionalCost;
    private ?bool $isFreightCollect;
    private ?int $shippingDeadline;
    private ?string $shippingDeadlineUnit;

    public function __construct(
        ?bool $auto,
        int $vendorCarrierId,
        ?int $baseCost,
        ?int $additionalCost,
        ?bool $isFreightCollect,
        ?int $shippingDeadline,
        ?string $shippingDeadlineUnit
    ) {
        $this->auto = $auto;
        $this->vendorCarrierId = $vendorCarrierId;
        $this->baseCost = $baseCost;
        $this->additionalCost = $additionalCost;
        $this->isFreightCollect = $isFreightCollect;
        $this->shippingDeadline = $shippingDeadline;
        $this->shippingDeadlineUnit = $shippingDeadlineUnit;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['auto'] ?? null,
            $data['vendor_carrier_id'],
            $data['base_cost'] ?? null,
            $data['additional_cost'] ?? null,
            $data['is_freight_collect'] ?? null,
            $data['shipping_deadline'] ?? null,
            $data['shipping_deadline_unit'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->auto !== null) {
            $result['auto'] = $this->auto;
        }
        $result['vendor_carrier_id'] = $this->vendorCarrierId;
        if ($this->baseCost !== null) {
            $result['base_cost'] = $this->baseCost;
        }
        if ($this->additionalCost !== null) {
            $result['additional_cost'] = $this->additionalCost;
        }
        if ($this->isFreightCollect !== null) {
            $result['is_freight_collect'] = $this->isFreightCollect;
        }
        if ($this->shippingDeadline !== null) {
            $result['shipping_deadline'] = $this->shippingDeadline;
        }
        if ($this->shippingDeadlineUnit !== null) {
            $result['shipping_deadline_unit'] = $this->shippingDeadlineUnit;
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getAuto(): ?bool
    {
        return $this->auto;
    }

    public function getVendorCarrierId(): int
    {
        return $this->vendorCarrierId;
    }

    public function getBaseCost(): ?int
    {
        return $this->baseCost;
    }

    public function getAdditionalCost(): ?int
    {
        return $this->additionalCost;
    }

    public function getIsFreightCollect(): ?bool
    {
        return $this->isFreightCollect;
    }

    public function getShippingDeadline(): ?int
    {
        return $this->shippingDeadline;
    }

    public function getShippingDeadlineUnit(): ?string
    {
        return $this->shippingDeadlineUnit;
    }
}
