<?php

namespace Basalam\Order\Models;

/**
 * Basket product model
 */
class BasketProduct implements \JsonSerializable
{
    private ?int $id;
    private ?string $title;
    private ?int $price;
    private ?int $primaryPrice;
    private ?int $stock;
    private ?BasketProductCategory $category;
    private ?array $photos;

    public function __construct(
        ?int                   $id = null,
        ?string                $title = null,
        ?int                   $price = null,
        ?int                   $primaryPrice = null,
        ?int                   $stock = null,
        ?BasketProductCategory $category = null,
        ?array                 $photos = null
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->primaryPrice = $primaryPrice;
        $this->stock = $stock;
        $this->category = $category;
        $this->photos = $photos;
    }

    public static function fromArray(array $data): self
    {
        $photos = null;
        if (isset($data['photos'])) {
            $photos = array_map(fn($p) => is_array($p) ? BasketProductPhoto::fromArray($p) : $p, $data['photos']);
        }

        return new self(
            $data['id'] ?? null,
            $data['title'] ?? null,
            $data['price'] ?? null,
            $data['primary_price'] ?? null,
            $data['stock'] ?? null,
            isset($data['category']) ? BasketProductCategory::fromArray($data['category']) : null,
            $photos
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->id !== null) $result['id'] = $this->id;
        if ($this->title !== null) $result['title'] = $this->title;
        if ($this->price !== null) $result['price'] = $this->price;
        if ($this->primaryPrice !== null) $result['primary_price'] = $this->primaryPrice;
        if ($this->stock !== null) $result['stock'] = $this->stock;
        if ($this->category !== null) $result['category'] = $this->category->toArray();
        if ($this->photos !== null) {
            $result['photos'] = array_map(fn($p) => $p instanceof BasketProductPhoto ? $p->toArray() : $p, $this->photos);
        }
        return $result;
    }

    // Getters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function getPrimaryPrice(): ?int
    {
        return $this->primaryPrice;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function getCategory(): ?BasketProductCategory
    {
        return $this->category;
    }

    public function getPhotos(): ?array
    {
        return $this->photos;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}