<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Summary response model for parcels.
 */
class ParcelSummaryResponse implements JsonSerializable
{
    private int $id;
    private int $totalItemsPrice;
    private string $createdAt;
    private string $updatedAt;
    private int $weight;
    private ?string $estimateSendAt;
    private Vendor $vendor;
    private ParcelOrder $order;
    private ?Status $status;
    private ShippingMethod $shippingMethod;
    private array $items;
    private ?PostReceipt $postReceipt;

    public function __construct(
        int            $id,
        int            $totalItemsPrice,
        string         $createdAt,
        string         $updatedAt,
        int            $weight,
        Vendor         $vendor,
        ParcelOrder    $order,
        ShippingMethod $shippingMethod,
        array          $items,
        ?string        $estimateSendAt = null,
        ?Status        $status = null,
        ?PostReceipt   $postReceipt = null
    )
    {
        $this->id = $id;
        $this->totalItemsPrice = $totalItemsPrice;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->weight = $weight;
        $this->vendor = $vendor;
        $this->order = $order;
        $this->shippingMethod = $shippingMethod;
        $this->items = $items;
        $this->estimateSendAt = $estimateSendAt;
        $this->status = $status;
        $this->postReceipt = $postReceipt;
    }

    public static function fromArray(array $data): self
    {
        $items = array_map(fn($item) => ParcelListItem::fromArray($item), $data['items']);

        return new self(
            $data['id'],
            $data['total_items_price'],
            $data['created_at'],
            $data['updated_at'],
            $data['weight'],
            Vendor::fromArray($data['vendor']),
            ParcelOrder::fromArray($data['order']),
            ShippingMethod::fromArray($data['shipping_method']),
            $items,
            $data['estimate_send_at'] ?? null,
            isset($data['status']) ? Status::fromArray($data['status']) : null,
            isset($data['post_receipt']) ? PostReceipt::fromArray($data['post_receipt']) : null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'total_items_price' => $this->totalItemsPrice,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'weight' => $this->weight,
            'estimate_send_at' => $this->estimateSendAt,
            'vendor' => $this->vendor->toArray(),
            'order' => $this->order->toArray(),
            'status' => $this->status?->toArray(),
            'shipping_method' => $this->shippingMethod->toArray(),
            'items' => array_map(fn($item) => $item->toArray(), $this->items),
            'post_receipt' => $this->postReceipt?->toArray(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}