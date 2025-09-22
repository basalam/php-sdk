<?php

namespace Basalam\Order\Models;

/**
 * Basket costs model
 */
class BasketCosts implements \JsonSerializable
{
    private ?CostBreakdown $delivery;
    private ?CostBreakdown $products;
    private ?TotalCostBreakdown $total;

    public function __construct(
        ?CostBreakdown      $delivery = null,
        ?CostBreakdown      $products = null,
        ?TotalCostBreakdown $total = null
    )
    {
        $this->delivery = $delivery;
        $this->products = $products;
        $this->total = $total;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['delivery']) ? CostBreakdown::fromArray($data['delivery']) : null,
            isset($data['products']) ? CostBreakdown::fromArray($data['products']) : null,
            isset($data['total']) ? TotalCostBreakdown::fromArray($data['total']) : null
        );
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->delivery !== null) {
            $result['delivery'] = $this->delivery->toArray();
        }
        if ($this->products !== null) {
            $result['products'] = $this->products->toArray();
        }
        if ($this->total !== null) {
            $result['total'] = $this->total->toArray();
        }

        return $result;
    }

    // Getters

    public function getDelivery(): ?CostBreakdown
    {
        return $this->delivery;
    }

    public function getProducts(): ?CostBreakdown
    {
        return $this->products;
    }

    public function getTotal(): ?TotalCostBreakdown
    {
        return $this->total;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}