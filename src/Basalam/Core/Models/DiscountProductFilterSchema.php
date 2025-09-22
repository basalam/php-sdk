<?php

namespace Basalam\Core\Models;

class DiscountProductFilterSchema implements \JsonSerializable
{
    public ?array $variation_ids;
    public ?array $product_ids;
    public ?array $status;
    public ?RangeFilterItem $stock;
    public ?RangeFilterItem $price;
    public ?array $exclude;
    public ?array $category_id;
    public ?string $title;

    public function __construct(array $data = [])
    {
        $this->variation_ids = $data['variation_ids'] ?? null;
        $this->product_ids = $data['product_ids'] ?? null;
        $this->status = $data['status'] ?? null;
        $this->stock = isset($data['stock'])
            ? new RangeFilterItem($data['stock'])
            : null;
        $this->price = isset($data['price'])
            ? new RangeFilterItem($data['price'])
            : null;
        $this->exclude = $data['exclude'] ?? null;
        $this->category_id = $data['category_id'] ?? null;
        $this->title = $data['title'] ?? null;
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->variation_ids !== null) $result['variation_ids'] = $this->variation_ids;
        if ($this->product_ids !== null) $result['product_ids'] = $this->product_ids;
        if ($this->status !== null) $result['status'] = $this->status;
        if ($this->stock !== null) $result['stock'] = $this->stock->toArray();
        if ($this->price !== null) $result['price'] = $this->price->toArray();
        if ($this->exclude !== null) $result['exclude'] = $this->exclude;
        if ($this->category_id !== null) $result['category_id'] = $this->category_id;
        if ($this->title !== null) $result['title'] = $this->title;

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}