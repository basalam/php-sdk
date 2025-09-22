<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Parcel information for customer item response.
 */
class CustomerItemParcel implements JsonSerializable
{
    private int $id;
    private string $createdAt;
    private string $updatedAt;
    private string $estimateSendAt;
    private Status $status;
    private ShippingMethod $shippingMethod;
    private Vendor $vendor;

    public function __construct(
        int            $id,
        string         $createdAt,
        string         $updatedAt,
        string         $estimateSendAt,
        Status         $status,
        ShippingMethod $shippingMethod,
        Vendor         $vendor
    )
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->estimateSendAt = $estimateSendAt;
        $this->status = $status;
        $this->shippingMethod = $shippingMethod;
        $this->vendor = $vendor;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['created_at'],
            $data['updated_at'],
            $data['estimate_send_at'],
            Status::fromArray($data['status']),
            ShippingMethod::fromArray($data['shipping_method']),
            Vendor::fromArray($data['vendor'])
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'estimate_send_at' => $this->estimateSendAt,
            'status' => $this->status->toArray(),
            'shipping_method' => $this->shippingMethod->toArray(),
            'vendor' => $this->vendor->toArray(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}