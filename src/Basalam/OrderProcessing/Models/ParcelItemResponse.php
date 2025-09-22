<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Parcel item response model.
 */
class ParcelItemResponse implements JsonSerializable
{
    private int $id;
    private string $title;
    private int $quantity;
    private int $weight;
    private int $price;
    private ?ItemLastStatus $lastItemStatus;
    private int $maxRefundAmount;
    private Product $product;
    private ?Variation $variation;

    public function __construct(
        int             $id,
        string          $title,
        int             $quantity,
        int             $weight,
        int             $price,
        int             $maxRefundAmount,
        Product         $product,
        ?ItemLastStatus $lastItemStatus = null,
        ?Variation      $variation = null
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->quantity = $quantity;
        $this->weight = $weight;
        $this->price = $price;
        $this->maxRefundAmount = $maxRefundAmount;
        $this->product = $product;
        $this->lastItemStatus = $lastItemStatus;
        $this->variation = $variation;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['title'],
            $data['quantity'],
            $data['weight'],
            $data['price'],
            $data['max_refund_amount'],
            Product::fromArray($data['product']),
            isset($data['last_item_status']) ? ItemLastStatus::fromArray($data['last_item_status']) : null,
            isset($data['variation']) ? Variation::fromArray($data['variation']) : null
        );
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
            'max_refund_amount' => $this->maxRefundAmount,
            'product' => $this->product->toArray(),
            'variation' => $this->variation?->toArray(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}