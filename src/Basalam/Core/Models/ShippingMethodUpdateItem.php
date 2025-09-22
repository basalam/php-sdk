<?php

namespace Basalam\Core\Models;

class ShippingMethodUpdateItem implements \JsonSerializable
{
    public ?int $method_id;
    public ?bool $is_customized;
    public ?int $base_cost;
    public ?int $additional_cost;
    public ?int $additional_dimensions_cost;

    public function __construct(array $data = [])
    {
        $this->method_id = $data['method_id'] ?? null;
        $this->is_customized = $data['is_customized'] ?? null;
        $this->base_cost = $data['base_cost'] ?? null;
        $this->additional_cost = $data['additional_cost'] ?? null;
        $this->additional_dimensions_cost = $data['additional_dimensions_cost'] ?? null;
    }

    public function toArray(): array
    {
        return array_filter([
            'method_id' => $this->method_id,
            'is_customized' => $this->is_customized,
            'base_cost' => $this->base_cost,
            'additional_cost' => $this->additional_cost,
            'additional_dimensions_cost' => $this->additional_dimensions_cost,
        ], fn($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}