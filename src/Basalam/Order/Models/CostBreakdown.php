<?php

namespace Basalam\Order\Models;

/**
 * Cost breakdown model
 */
class CostBreakdown implements \JsonSerializable
{
    private ?int $base;
    private ?int $discount;
    private ?int $grand;

    public function __construct(
        ?int $base = null,
        ?int $discount = null,
        ?int $grand = null
    )
    {
        $this->base = $base;
        $this->discount = $discount;
        $this->grand = $grand;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['base'] ?? null,
            $data['discount'] ?? null,
            $data['grand'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->base !== null) {
            $result['base'] = $this->base;
        }
        if ($this->discount !== null) {
            $result['discount'] = $this->discount;
        }
        if ($this->grand !== null) {
            $result['grand'] = $this->grand;
        }

        return $result;
    }

    // Getters

    public function getBase(): ?int
    {
        return $this->base;
    }

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function getGrand(): ?int
    {
        return $this->grand;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}