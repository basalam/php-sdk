<?php

namespace Basalam\Core\Models;

class UpdateProductRequestItem implements \JsonSerializable
{
    public ?int $id = null;
    public ?string $name = null;
    public ?int $primary_price = null;
    public ?int $order = null;
    public ?int $stock = null;
    public ?int $status = null;
    public ?int $preparation_days = null;
    public ?array $variants = null;
    public ?array $product_attribute = null;
    public ?ShippingDataRequestItem $shipping_data = null;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->primary_price = $data['primary_price'] ?? null;
        $this->order = $data['order'] ?? null;
        $this->stock = $data['stock'] ?? null;
        $this->status = $data['status'] ?? null;
        $this->preparation_days = $data['preparation_days'] ?? null;

        if (isset($data['variants'])) {
            $this->variants = array_map(
                fn($variant) => new UpdateVariantRequestItem($variant),
                $data['variants']
            );
        }

        if (isset($data['product_attribute'])) {
            $this->product_attribute = array_map(
                fn($attr) => new ProductAttributeRequestItem($attr),
                $data['product_attribute']
            );
        }

        $this->shipping_data = isset($data['shipping_data'])
            ? new ShippingDataRequestItem($data['shipping_data'])
            : null;
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->id !== null) $result['id'] = $this->id;
        if ($this->name !== null) $result['name'] = $this->name;
        if ($this->primary_price !== null) $result['primary_price'] = $this->primary_price;
        if ($this->order !== null) $result['order'] = $this->order;
        if ($this->stock !== null) $result['stock'] = $this->stock;
        if ($this->status !== null) $result['status'] = $this->status;
        if ($this->preparation_days !== null) $result['preparation_days'] = $this->preparation_days;

        if ($this->variants !== null) {
            $result['variants'] = array_map(
                fn($variant) => $variant->toArray(),
                $this->variants
            );
        }

        if ($this->product_attribute !== null) {
            $result['product_attribute'] = array_map(
                fn($attr) => $attr->toArray(),
                $this->product_attribute
            );
        }

        if ($this->shipping_data !== null) {
            $result['shipping_data'] = $this->shipping_data->toArray();
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}