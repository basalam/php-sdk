<?php

namespace Basalam\Core\Models;

class GetProductsQuerySchema implements \JsonSerializable
{
    public ?int $category_id;
    public ?string $created_at;
    public ?array $ids;
    public ?int $page = 1;
    public ?int $per_page = 10;
    public ?string $price;
    public ?string $product_title;
    public ?string $sort = "id:desc";
    public ?int $status;
    public ?array $vendor_ids;
    public ?string $vendor_mobile;
    public ?string $vendor_title;

    public function __construct(array $data = [])
    {
        $this->category_id = $data['category_id'] ?? null;
        $this->created_at = $data['created_at'] ?? null;
        $this->ids = $data['ids'] ?? null;
        $this->page = $data['page'] ?? 1;
        $this->per_page = $data['per_page'] ?? 10;
        $this->price = $data['price'] ?? null;
        $this->product_title = $data['product_title'] ?? null;
        $this->sort = $data['sort'] ?? "id:desc";
        $this->status = $data['status'] ?? null;
        $this->vendor_ids = $data['vendor_ids'] ?? null;
        $this->vendor_mobile = $data['vendor_mobile'] ?? null;
        $this->vendor_title = $data['vendor_title'] ?? null;
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->category_id !== null) $result['category_id'] = $this->category_id;
        if ($this->created_at !== null) $result['created_at'] = $this->created_at;
        if ($this->ids !== null) $result['ids'] = $this->ids;
        if ($this->page !== null) $result['page'] = $this->page;
        if ($this->per_page !== null) $result['per_page'] = $this->per_page;
        if ($this->price !== null) $result['price'] = $this->price;
        if ($this->product_title !== null) $result['product_title'] = $this->product_title;
        if ($this->sort !== null) $result['sort'] = $this->sort;
        if ($this->status !== null) $result['status'] = $this->status;
        if ($this->vendor_ids !== null) $result['vendor_ids'] = $this->vendor_ids;
        if ($this->vendor_mobile !== null) $result['vendor_mobile'] = $this->vendor_mobile;
        if ($this->vendor_title !== null) $result['vendor_title'] = $this->vendor_title;

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}