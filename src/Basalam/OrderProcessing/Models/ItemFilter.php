<?php

namespace Basalam\OrderProcessing\Models;

/**
 * Filter for customer items requests.
 */
class ItemFilter implements \JsonSerializable
{
    private ?string $createdAt;
    private ?string $cursor;
    private ?string $customerIds;
    private ?string $ids;
    private ?string $orderIds;
    private ?int $perPage;
    private ?string $productIds;
    private ?string $sort;
    private ?string $vendorIds;

    public function __construct(
        ?string $createdAt = null,
        ?string $cursor = null,
        ?string $customerIds = null,
        ?string $ids = null,
        ?string $orderIds = null,
        ?int    $perPage = 10,
        ?string $productIds = null,
        ?string $sort = 'created_at:desc',
        ?string $vendorIds = null
    )
    {
        $this->createdAt = $createdAt;
        $this->cursor = $cursor;
        $this->customerIds = $customerIds;
        $this->ids = $ids;
        $this->orderIds = $orderIds;
        $this->perPage = $perPage;
        $this->productIds = $productIds;
        $this->sort = $sort;
        $this->vendorIds = $vendorIds;
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->createdAt !== null) {
            $result['created_at'] = $this->createdAt;
        }
        if ($this->cursor !== null) {
            $result['cursor'] = $this->cursor;
        }
        if ($this->customerIds !== null) {
            $result['customer_ids'] = $this->customerIds;
        }
        if ($this->ids !== null) {
            $result['ids'] = $this->ids;
        }
        if ($this->orderIds !== null) {
            $result['order_ids'] = $this->orderIds;
        }
        if ($this->perPage !== null) {
            $result['per_page'] = $this->perPage;
        }
        if ($this->productIds !== null) {
            $result['product_ids'] = $this->productIds;
        }
        if ($this->sort !== null) {
            $result['sort'] = $this->sort;
        }
        if ($this->vendorIds !== null) {
            $result['vendor_ids'] = $this->vendorIds;
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}