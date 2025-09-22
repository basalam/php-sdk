<?php

namespace Basalam\Core\Models;

class ShippingMethodResponse implements \JsonSerializable
{
    public ?int $id;
    public ?ShippingMethodInfo $method;
    public ?int $base_cost;
    public ?int $additional_cost;
    public ?bool $is_private;
    public ?int $additional_dimensions_cost;
    public ?int $vendor_id;
    public ?string $deleted_at;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->method = isset($data['method'])
            ? ShippingMethodInfo::fromArray($data['method'])
            : null;
        $model->base_cost = $data['base_cost'] ?? null;
        $model->additional_cost = $data['additional_cost'] ?? null;
        $model->is_private = $data['is_private'] ?? null;
        $model->additional_dimensions_cost = $data['additional_dimensions_cost'] ?? null;
        $model->vendor_id = $data['vendor_id'] ?? null;
        $model->deleted_at = $data['deleted_at'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'method' => $this->method?->toArray(),
            'base_cost' => $this->base_cost,
            'additional_cost' => $this->additional_cost,
            'is_private' => $this->is_private,
            'additional_dimensions_cost' => $this->additional_dimensions_cost,
            'vendor_id' => $this->vendor_id,
            'deleted_at' => $this->deleted_at,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}