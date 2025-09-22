<?php

namespace Basalam\Core\Models;

class VariantRequestItem implements \JsonSerializable
{
    public int $primary_price;
    public int $stock;
    public ?string $sku;
    public array $properties;

    public function __construct(array $data)
    {
        $this->primary_price = $data['primary_price'];
        $this->stock = $data['stock'];
        $this->sku = $data['sku'] ?? null;
        $this->properties = array_map(
            fn($prop) => new VariantPropertyRequestItem($prop),
            $data['properties']
        );
    }

    public function toArray(): array
    {
        $result = [
            'primary_price' => $this->primary_price,
            'stock' => $this->stock,
            'properties' => array_map(fn($prop) => $prop->toArray(), $this->properties),
        ];
        if ($this->sku !== null) $result['sku'] = $this->sku;
        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}