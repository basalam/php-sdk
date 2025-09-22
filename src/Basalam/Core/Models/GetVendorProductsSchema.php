<?php

namespace Basalam\Core\Models;

class GetVendorProductsSchema implements \JsonSerializable
{
    public ?string $title;
    public ?array $category;
    public ?array $statuses;
    public ?int $stock_gte;
    public ?int $stock_lte;
    public ?int $preparation_day_gte;
    public ?int $preparation_day_lte;
    public ?int $price_gte;
    public ?int $price_lte;
    public ?array $ids;
    public ?array $skus;
    public ?int $illegal_free_shipping_for_iran;
    public ?int $illegal_free_shipping_for_same_city;
    public int $page = 1;
    public int $per_page = 10;
    public bool $variants_flatting = true;
    public ?bool $is_wholesale;
    public ?string $sort;

    public function __construct(array $data = [])
    {
        $this->title = $data['title'] ?? null;
        $this->category = $data['category'] ?? null;
        $this->statuses = $data['statuses'] ?? null;
        $this->stock_gte = $data['stock_gte'] ?? null;
        $this->stock_lte = $data['stock_lte'] ?? null;
        $this->preparation_day_gte = $data['preparation_day_gte'] ?? null;
        $this->preparation_day_lte = $data['preparation_day_lte'] ?? null;
        $this->price_gte = $data['price_gte'] ?? null;
        $this->price_lte = $data['price_lte'] ?? null;
        $this->ids = $data['ids'] ?? null;
        $this->skus = $data['skus'] ?? null;
        $this->illegal_free_shipping_for_iran = $data['illegal_free_shipping_for_iran'] ?? null;
        $this->illegal_free_shipping_for_same_city = $data['illegal_free_shipping_for_same_city'] ?? null;
        $this->page = $data['page'] ?? 1;
        $this->per_page = $data['per_page'] ?? 10;
        $this->variants_flatting = $data['variants_flatting'] ?? true;
        $this->is_wholesale = $data['is_wholesale'] ?? null;
        $this->sort = $data['sort'] ?? null;
    }

    public function toArray(): array
    {
        $result = [
            'page' => $this->page,
            'per_page' => $this->per_page,
            'variants_flatting' => $this->variants_flatting,
        ];

        if ($this->title !== null) $result['title'] = $this->title;
        if ($this->category !== null) $result['category'] = $this->category;
        if ($this->statuses !== null) $result['statuses'] = $this->statuses;
        if ($this->stock_gte !== null) $result['stock_gte'] = $this->stock_gte;
        if ($this->stock_lte !== null) $result['stock_lte'] = $this->stock_lte;
        if ($this->preparation_day_gte !== null) $result['preparation_day_gte'] = $this->preparation_day_gte;
        if ($this->preparation_day_lte !== null) $result['preparation_day_lte'] = $this->preparation_day_lte;
        if ($this->price_gte !== null) $result['price_gte'] = $this->price_gte;
        if ($this->price_lte !== null) $result['price_lte'] = $this->price_lte;
        if ($this->ids !== null) $result['ids'] = $this->ids;
        if ($this->skus !== null) $result['skus'] = $this->skus;
        if ($this->illegal_free_shipping_for_iran !== null) $result['illegal_free_shipping_for_iran'] = $this->illegal_free_shipping_for_iran;
        if ($this->illegal_free_shipping_for_same_city !== null) $result['illegal_free_shipping_for_same_city'] = $this->illegal_free_shipping_for_same_city;
        if ($this->is_wholesale !== null) $result['is_wholesale'] = $this->is_wholesale;
        if ($this->sort !== null) $result['sort'] = $this->sort;

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}