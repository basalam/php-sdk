<?php

namespace Basalam\Core\Models;

class UpdateVariantRequestItem implements \JsonSerializable
{
    public ?int $id;
    public ?int $primary_price;
    public ?int $stock;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->primary_price = $data['primary_price'] ?? null;
        $this->stock = $data['stock'] ?? null;
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'primary_price' => $this->primary_price,
            'stock' => $this->stock,
        ], fn($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}