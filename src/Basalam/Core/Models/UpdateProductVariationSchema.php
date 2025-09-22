<?php

namespace Basalam\Core\Models;

class UpdateProductVariationSchema implements \JsonSerializable
{
    public ?int $primary_price;
    public ?int $stock;
    public ?string $sku;

    public function __construct(array $data = [])
    {
        $this->primary_price = $data['primary_price'] ?? null;
        $this->stock = $data['stock'] ?? null;
        $this->sku = $data['sku'] ?? null;
    }

    public function toArray(): array
    {
        return array_filter([
            'primary_price' => $this->primary_price,
            'stock' => $this->stock,
            'sku' => $this->sku,
        ], fn($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}