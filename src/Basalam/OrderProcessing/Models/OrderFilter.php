<?php

namespace Basalam\OrderProcessing\Models;

/**
 * Filter for customer orders requests.
 */
class OrderFilter implements \JsonSerializable
{
    private ?string $couponCode;
    private ?string $cursor;
    private ?string $customerIds;
    private ?string $customerName;
    private ?string $ids;
    private ?string $itemsTitle;
    private ?string $paidAt;
    private ?string $parcelEstimateSendAt;
    private ?array $parcelStatuses;
    private ?int $perPage;
    private ?string $productIds;
    private ?string $sort;
    private ?string $vendorIds;

    public function __construct(
        ?string $couponCode = null,
        ?string $cursor = null,
        ?string $customerIds = null,
        ?string $customerName = null,
        ?string $ids = null,
        ?string $itemsTitle = null,
        ?string $paidAt = null,
        ?string $parcelEstimateSendAt = null,
        ?array  $parcelStatuses = null,
        ?int    $perPage = 10,
        ?string $productIds = null,
        ?string $sort = 'paid_at:desc',
        ?string $vendorIds = null
    )
    {
        $this->couponCode = $couponCode;
        $this->cursor = $cursor;
        $this->customerIds = $customerIds;
        $this->customerName = $customerName;
        $this->ids = $ids;
        $this->itemsTitle = $itemsTitle;
        $this->paidAt = $paidAt;
        $this->parcelEstimateSendAt = $parcelEstimateSendAt;
        $this->parcelStatuses = $parcelStatuses;
        $this->perPage = $perPage;
        $this->productIds = $productIds;
        $this->sort = $sort;
        $this->vendorIds = $vendorIds;
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->couponCode !== null) {
            $result['coupon_code'] = $this->couponCode;
        }
        if ($this->cursor !== null) {
            $result['cursor'] = $this->cursor;
        }
        if ($this->customerIds !== null) {
            $result['customer_ids'] = $this->customerIds;
        }
        if ($this->customerName !== null) {
            $result['customer_name'] = $this->customerName;
        }
        if ($this->ids !== null) {
            $result['ids'] = $this->ids;
        }
        if ($this->itemsTitle !== null) {
            $result['items_title'] = $this->itemsTitle;
        }
        if ($this->paidAt !== null) {
            $result['paid_at'] = $this->paidAt;
        }
        if ($this->parcelEstimateSendAt !== null) {
            $result['parcel_estimate_send_at'] = $this->parcelEstimateSendAt;
        }
        if ($this->parcelStatuses !== null) {
            $result['parcel_statuses'] = $this->parcelStatuses;
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