<?php

namespace Basalam\Shipping\Models;

/**
 * UpdateOwnRatesRequest model.
 */
class UpdateOwnRatesRequest implements \JsonSerializable
{
    private int $deliveryEstimateId;
    private ?int $cost;
    private ?int $shippingDeadline;
    private ?string $shippingDeadlineUnit;
    private ?bool $isFreightCollect;
    private ?int $freightEstimatedCost;
    private ?int $minBasketWeight;
    private ?int $maxBasketWeight;
    private ?int $weightUnit;
    private ?int $minBasketPrice;
    private ?int $maxBasketPrice;
    private ?int $status;

    public function __construct(
        int $deliveryEstimateId,
        ?int $cost,
        ?int $shippingDeadline,
        ?string $shippingDeadlineUnit,
        ?bool $isFreightCollect,
        ?int $freightEstimatedCost,
        ?int $minBasketWeight,
        ?int $maxBasketWeight,
        ?int $weightUnit,
        ?int $minBasketPrice,
        ?int $maxBasketPrice,
        ?int $status
    ) {
        $this->deliveryEstimateId = $deliveryEstimateId;
        $this->cost = $cost;
        $this->shippingDeadline = $shippingDeadline;
        $this->shippingDeadlineUnit = $shippingDeadlineUnit;
        $this->isFreightCollect = $isFreightCollect;
        $this->freightEstimatedCost = $freightEstimatedCost;
        $this->minBasketWeight = $minBasketWeight;
        $this->maxBasketWeight = $maxBasketWeight;
        $this->weightUnit = $weightUnit;
        $this->minBasketPrice = $minBasketPrice;
        $this->maxBasketPrice = $maxBasketPrice;
        $this->status = $status;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['delivery_estimate_id'],
            $data['cost'] ?? null,
            $data['shipping_deadline'] ?? null,
            $data['shipping_deadline_unit'] ?? null,
            $data['is_freight_collect'] ?? null,
            $data['freight_estimated_cost'] ?? null,
            $data['min_basket_weight'] ?? null,
            $data['max_basket_weight'] ?? null,
            $data['weight_unit'] ?? null,
            $data['min_basket_price'] ?? null,
            $data['max_basket_price'] ?? null,
            $data['status'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['delivery_estimate_id'] = $this->deliveryEstimateId;
        $result['cost'] = $this->cost;
        if ($this->shippingDeadline !== null) {
            $result['shipping_deadline'] = $this->shippingDeadline;
        }
        if ($this->shippingDeadlineUnit !== null) {
            $result['shipping_deadline_unit'] = $this->shippingDeadlineUnit;
        }
        if ($this->isFreightCollect !== null) {
            $result['is_freight_collect'] = $this->isFreightCollect;
        }
        if ($this->freightEstimatedCost !== null) {
            $result['freight_estimated_cost'] = $this->freightEstimatedCost;
        }
        if ($this->minBasketWeight !== null) {
            $result['min_basket_weight'] = $this->minBasketWeight;
        }
        if ($this->maxBasketWeight !== null) {
            $result['max_basket_weight'] = $this->maxBasketWeight;
        }
        if ($this->weightUnit !== null) {
            $result['weight_unit'] = $this->weightUnit;
        }
        if ($this->minBasketPrice !== null) {
            $result['min_basket_price'] = $this->minBasketPrice;
        }
        if ($this->maxBasketPrice !== null) {
            $result['max_basket_price'] = $this->maxBasketPrice;
        }
        if ($this->status !== null) {
            $result['status'] = $this->status;
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getDeliveryEstimateId(): int
    {
        return $this->deliveryEstimateId;
    }

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function getShippingDeadline(): ?int
    {
        return $this->shippingDeadline;
    }

    public function getShippingDeadlineUnit(): ?string
    {
        return $this->shippingDeadlineUnit;
    }

    public function getIsFreightCollect(): ?bool
    {
        return $this->isFreightCollect;
    }

    public function getFreightEstimatedCost(): ?int
    {
        return $this->freightEstimatedCost;
    }

    public function getMinBasketWeight(): ?int
    {
        return $this->minBasketWeight;
    }

    public function getMaxBasketWeight(): ?int
    {
        return $this->maxBasketWeight;
    }

    public function getWeightUnit(): ?int
    {
        return $this->weightUnit;
    }

    public function getMinBasketPrice(): ?int
    {
        return $this->minBasketPrice;
    }

    public function getMaxBasketPrice(): ?int
    {
        return $this->maxBasketPrice;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }
}
