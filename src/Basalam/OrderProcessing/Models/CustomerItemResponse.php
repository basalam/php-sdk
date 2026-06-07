<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Customer item response model.
 */
class CustomerItemResponse implements JsonSerializable
{
    private int $id;
    private string $title;
    private int $quantity;
    private int $weight;
    private int $price;
    private ?ItemLastStatus $lastItemStatus;
    private CustomerItemParcel $parcel;
    private ParcelOrder $order;
    private Product $product;
    private ?Variation $variation;
    private ?int $maxRefundAmount;

    public function __construct(
        int                $id,
        string             $title,
        int                $quantity,
        int                $weight,
        int                $price,
        CustomerItemParcel $parcel,
        ParcelOrder        $order,
        Product            $product,
        ?ItemLastStatus    $lastItemStatus = null,
        ?Variation         $variation = null,
        ?int               $maxRefundAmount = null
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->quantity = $quantity;
        $this->weight = $weight;
        $this->price = $price;
        $this->parcel = $parcel;
        $this->order = $order;
        $this->product = $product;
        $this->lastItemStatus = $lastItemStatus;
        $this->variation = $variation;
        $this->maxRefundAmount = $maxRefundAmount;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['title'],
            $data['quantity'],
            $data['weight'],
            $data['price'],
            CustomerItemParcel::fromArray($data['parcel']),
            ParcelOrder::fromArray($data['order']),
            Product::fromArray($data['product']),
            isset($data['last_item_status']) ? ItemLastStatus::fromArray($data['last_item_status']) : null,
            isset($data['variation']) ? Variation::fromArray($data['variation']) : null,
            $data['max_refund_amount'] ?? null
        );
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getLastItemStatus(): ?ItemLastStatus
    {
        return $this->lastItemStatus;
    }

    public function getParcel(): CustomerItemParcel
    {
        return $this->parcel;
    }

    public function getOrder(): ParcelOrder
    {
        return $this->order;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getVariation(): ?Variation
    {
        return $this->variation;
    }

    public function getMaxRefundAmount(): ?int
    {
        return $this->maxRefundAmount;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'quantity' => $this->quantity,
            'weight' => $this->weight,
            'price' => $this->price,
            'last_item_status' => $this->lastItemStatus?->toArray(),
            'parcel' => $this->parcel->toArray(),
            'order' => $this->order->toArray(),
            'product' => $this->product->toArray(),
            'variation' => $this->variation?->toArray(),
            'max_refund_amount' => $this->maxRefundAmount,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}