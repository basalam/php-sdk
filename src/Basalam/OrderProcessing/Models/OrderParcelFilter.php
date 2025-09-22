<?php

namespace Basalam\OrderProcessing\Models;

/**
 * Filter for order parcel requests.
 */
class OrderParcelFilter implements \JsonSerializable
{
    private ?string $createdAt;
    private ?string $cursor;
    private ?string $estimateSendAt;
    private ?string $ids;
    private ?string $itemsCustomerIds;
    private ?string $itemsOrderIds;
    private ?array $itemsProductIds;
    private ?array $itemsVendorIds;
    private ?int $perPage;
    private ?string $sort;
    private ?array $statuses;

    public function __construct(
        ?string $createdAt = null,
        ?string $cursor = null,
        ?string $estimateSendAt = null,
        ?string $ids = null,
        ?string $itemsCustomerIds = null,
        ?string $itemsOrderIds = null,
        ?array  $itemsProductIds = null,
        ?array  $itemsVendorIds = null,
        ?int    $perPage = 10,
        ?string $sort = 'estimate_send_at:desc',
        ?array  $statuses = null
    )
    {
        $this->createdAt = $createdAt;
        $this->cursor = $cursor;
        $this->estimateSendAt = $estimateSendAt;
        $this->ids = $ids;
        $this->itemsCustomerIds = $itemsCustomerIds;
        $this->itemsOrderIds = $itemsOrderIds;
        $this->itemsProductIds = $itemsProductIds;
        $this->itemsVendorIds = $itemsVendorIds;
        $this->perPage = $perPage;
        $this->sort = $sort;
        $this->statuses = $statuses;
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
        if ($this->estimateSendAt !== null) {
            $result['estimate_send_at'] = $this->estimateSendAt;
        }
        if ($this->ids !== null) {
            $result['ids'] = $this->ids;
        }
        if ($this->itemsCustomerIds !== null) {
            $result['items_customer_ids'] = $this->itemsCustomerIds;
        }
        if ($this->itemsOrderIds !== null) {
            $result['items_order_ids'] = $this->itemsOrderIds;
        }
        if ($this->itemsProductIds !== null) {
            $result['items_product_ids'] = $this->itemsProductIds;
        }
        if ($this->itemsVendorIds !== null) {
            $result['items_vendor_ids'] = $this->itemsVendorIds;
        }
        if ($this->perPage !== null) {
            $result['per_page'] = $this->perPage;
        }
        if ($this->sort !== null) {
            $result['sort'] = $this->sort;
        }
        if ($this->statuses !== null) {
            $result['statuses'] = $this->statuses;
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    // Getters and Setters
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getCursor(): ?string
    {
        return $this->cursor;
    }

    public function getEstimateSendAt(): ?string
    {
        return $this->estimateSendAt;
    }

    public function getIds(): ?string
    {
        return $this->ids;
    }

    public function getItemsCustomerIds(): ?string
    {
        return $this->itemsCustomerIds;
    }

    public function getItemsOrderIds(): ?string
    {
        return $this->itemsOrderIds;
    }

    public function getItemsProductIds(): ?array
    {
        return $this->itemsProductIds;
    }

    public function getItemsVendorIds(): ?array
    {
        return $this->itemsVendorIds;
    }

    public function getPerPage(): ?int
    {
        return $this->perPage;
    }

    public function getSort(): ?string
    {
        return $this->sort;
    }

    public function getStatuses(): ?array
    {
        return $this->statuses;
    }
}

