<?php

namespace Basalam\Core\Models;

class ProductVariantResponse implements \JsonSerializable
{
    public ?int $id;
    public ?int $price;
    public ?int $primary_price;
    public ?int $stock;
    public ?int $order;
    public ?array $properties;
    public ?string $sku;
    public ?array $discount;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->price = $data['price'] ?? null;
        $model->primary_price = $data['primary_price'] ?? null;
        $model->stock = $data['stock'] ?? null;
        $model->order = $data['order'] ?? null;
        $model->properties = isset($data['properties'])
            ? array_map(fn($prop) => VariantPropertyResponse::fromArray($prop), $data['properties'])
            : null;
        $model->sku = $data['sku'] ?? null;
        $model->discount = $data['discount'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'primary_price' => $this->primary_price,
            'stock' => $this->stock,
            'order' => $this->order,
            'properties' => $this->properties ? array_map(fn($prop) => $prop->toArray(), $this->properties) : null,
            'sku' => $this->sku,
            'discount' => $this->discount,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}