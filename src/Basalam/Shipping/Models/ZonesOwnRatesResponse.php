<?php

namespace Basalam\Shipping\Models;

use DateTime;

/**
 * ZonesOwnRatesResponse model.
 */
class ZonesOwnRatesResponse implements \JsonSerializable
{
    private int $id;
    private string $title;
    private DeliveryEstimatesResponse $deliveryEstimate;
    private ?int $cost;
    private bool $isFreightCollect;
    private ?int $shippingDeadline;
    private ?array $shippingDeadlineUnit;
    private ?int $freightEstimatedCost;
    private ?int $minBasketWeight;
    private ?int $maxBasketWeight;
    private ?array $weightUnit;
    private ?int $minBasketPrice;
    private ?int $maxBasketPrice;
    private array $status;
    private string $hint;
    private ?DateTime $createdAt;
    private ?DateTime $updatedAt;

    public function __construct(
        int $id,
        string $title,
        DeliveryEstimatesResponse $deliveryEstimate,
        ?int $cost,
        bool $isFreightCollect,
        ?int $shippingDeadline,
        ?array $shippingDeadlineUnit,
        ?int $freightEstimatedCost,
        ?int $minBasketWeight,
        ?int $maxBasketWeight,
        ?array $weightUnit,
        ?int $minBasketPrice,
        ?int $maxBasketPrice,
        array $status,
        string $hint,
        ?DateTime $createdAt,
        ?DateTime $updatedAt
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->deliveryEstimate = $deliveryEstimate;
        $this->cost = $cost;
        $this->isFreightCollect = $isFreightCollect;
        $this->shippingDeadline = $shippingDeadline;
        $this->shippingDeadlineUnit = $shippingDeadlineUnit;
        $this->freightEstimatedCost = $freightEstimatedCost;
        $this->minBasketWeight = $minBasketWeight;
        $this->maxBasketWeight = $maxBasketWeight;
        $this->weightUnit = $weightUnit;
        $this->minBasketPrice = $minBasketPrice;
        $this->maxBasketPrice = $maxBasketPrice;
        $this->status = $status;
        $this->hint = $hint;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['title'],
            DeliveryEstimatesResponse::fromArray($data['delivery_estimate']),
            $data['cost'] ?? null,
            $data['is_freight_collect'],
            $data['shipping_deadline'] ?? null,
            $data['shipping_deadline_unit'] ?? null,
            $data['freight_estimated_cost'] ?? null,
            $data['min_basket_weight'] ?? null,
            $data['max_basket_weight'] ?? null,
            $data['weight_unit'] ?? null,
            $data['min_basket_price'] ?? null,
            $data['max_basket_price'] ?? null,
            $data['status'],
            $data['hint'],
            isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            isset($data['updated_at']) ? new DateTime($data['updated_at']) : null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['id'] = $this->id;
        $result['title'] = $this->title;
        $result['delivery_estimate'] = $this->deliveryEstimate->toArray();
        $result['cost'] = $this->cost;
        $result['is_freight_collect'] = $this->isFreightCollect;
        if ($this->shippingDeadline !== null) {
            $result['shipping_deadline'] = $this->shippingDeadline;
        }
        if ($this->shippingDeadlineUnit !== null) {
            $result['shipping_deadline_unit'] = $this->shippingDeadlineUnit;
        }
        $result['freight_estimated_cost'] = $this->freightEstimatedCost;
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
        $result['status'] = $this->status;
        $result['hint'] = $this->hint;
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

    public function getDeliveryEstimate(): DeliveryEstimatesResponse
    {
        return $this->deliveryEstimate;
    }

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function getIsFreightCollect(): bool
    {
        return $this->isFreightCollect;
    }

    public function getShippingDeadline(): ?int
    {
        return $this->shippingDeadline;
    }

    public function getShippingDeadlineUnit(): ?array
    {
        return $this->shippingDeadlineUnit;
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

    public function getWeightUnit(): ?array
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

    public function getStatus(): array
    {
        return $this->status;
    }

    public function getHint(): string
    {
        return $this->hint;
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
