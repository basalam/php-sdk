<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Parcel model.
 */
class Parcel implements JsonSerializable
{
    private int $id;
    private int $totalItemsPrice;
    private string $createdAt;
    private string $updatedAt;
    private ?string $estimateSendAt;
    private ?Status $status;
    private ShippingMethod $shippingMethod;
    private Vendor $vendor;
    private array $items;

    public function __construct(
        int            $id,
        int            $totalItemsPrice,
        string         $createdAt,
        string         $updatedAt,
        ShippingMethod $shippingMethod,
        Vendor         $vendor,
        array          $items,
        ?string        $estimateSendAt = null,
        ?Status        $status = null
    )
    {
        $this->id = $id;
        $this->totalItemsPrice = $totalItemsPrice;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->shippingMethod = $shippingMethod;
        $this->vendor = $vendor;
        $this->items = $items;
        $this->estimateSendAt = $estimateSendAt;
        $this->status = $status;
    }

    public static function fromArray(array $data): self
    {
        $items = array_map(fn($item) => ParcelItem::fromArray($item), $data['items']);

        return new self(
            $data['id'],
            $data['total_items_price'],
            $data['created_at'],
            $data['updated_at'],
            ShippingMethod::fromArray($data['shipping_method']),
            Vendor::fromArray($data['vendor']),
            $items,
            $data['estimate_send_at'] ?? null,
            isset($data['status']) ? Status::fromArray($data['status']) : null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'total_items_price' => $this->totalItemsPrice,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'estimate_send_at' => $this->estimateSendAt,
            'status' => $this->status?->toArray(),
            'shipping_method' => $this->shippingMethod->toArray(),
            'vendor' => $this->vendor->toArray(),
            'items' => array_map(fn($item) => $item->toArray(), $this->items),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}