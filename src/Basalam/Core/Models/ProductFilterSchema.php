<?php

namespace Basalam\Core\Models;

class ProductFilterSchema implements \JsonSerializable
{
    public ?string $title;
    public ?array $product_id;
    public ?array $category;
    public ?array $status;
    public ?RangeFilterItem $stock;
    public ?RangeFilterItem $preparation_day;
    public ?RangeFilterItem $price;
    public ?array $exclude;
    public ?bool $is_wholesale;
    public ?array $revision_status;

    public function __construct(array $data = [])
    {
        $this->title = $data['title'] ?? null;
        $this->product_id = $data['product_id'] ?? null;
        $this->category = $data['category'] ?? null;
        $this->status = $data['status'] ?? null;
        $this->stock = isset($data['stock'])
            ? new RangeFilterItem($data['stock'])
            : null;
        $this->preparation_day = isset($data['preparation_day'])
            ? new RangeFilterItem($data['preparation_day'])
            : null;
        $this->price = isset($data['price'])
            ? new RangeFilterItem($data['price'])
            : null;
        $this->exclude = $data['exclude'] ?? null;
        $this->is_wholesale = $data['is_wholesale'] ?? null;
        $this->revision_status = $data['revision_status'] ?? null;
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->title !== null) $result['title'] = $this->title;
        if ($this->product_id !== null) $result['product_id'] = $this->product_id;
        if ($this->category !== null) $result['category'] = $this->category;
        if ($this->status !== null) $result['status'] = $this->status;
        if ($this->stock !== null) $result['stock'] = $this->stock->toArray();
        if ($this->preparation_day !== null) $result['preparation_day'] = $this->preparation_day->toArray();
        if ($this->price !== null) $result['price'] = $this->price->toArray();
        if ($this->exclude !== null) $result['exclude'] = $this->exclude;
        if ($this->is_wholesale !== null) $result['is_wholesale'] = $this->is_wholesale;
        if ($this->revision_status !== null) $result['revision_status'] = $this->revision_status;

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function getIsWholesale(): ?bool
    {
        return $this->is_wholesale;
    }

    public function getRevisionStatus(): ?array
    {
        return $this->revision_status;
    }
}