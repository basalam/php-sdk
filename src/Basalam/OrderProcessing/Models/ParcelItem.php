<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Parcel item model.
 */
class ParcelItem implements JsonSerializable
{
    private int $id;
    private string $title;
    private int $quantity;
    private float $weight;
    private ?float $netWeight;
    private int $price;
    private Product $product;
    private ?Variation $variation;

    public function __construct(
        int        $id,
        string     $title,
        int        $quantity,
        float      $weight,
        int        $price,
        Product    $product,
        ?float     $netWeight = null,
        ?Variation $variation = null
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->quantity = $quantity;
        $this->weight = $weight;
        $this->price = $price;
        $this->product = $product;
        $this->netWeight = $netWeight;
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
            Product::fromArray($data['product']),
            $data['net_weight'] ?? null,
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
            'net_weight' => $this->netWeight,
            'price' => $this->price,
            'product' => $this->product->toArray(),
            'variation' => $this->variation?->toArray(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}

