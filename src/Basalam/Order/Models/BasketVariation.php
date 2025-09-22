<?php

namespace Basalam\Order\Models;

/**
 * Basket variation model
 */
class BasketVariation implements \JsonSerializable
{
    private ?int $id;
    private ?int $stock;
    private ?int $price;
    private ?int $primaryPrice;
    private ?array $properties;

    public function __construct(
        ?int   $id = null,
        ?int   $stock = null,
        ?int   $price = null,
        ?int   $primaryPrice = null,
        ?array $properties = null
    )
    {
        $this->id = $id;
        $this->stock = $stock;
        $this->price = $price;
        $this->primaryPrice = $primaryPrice;
        $this->properties = $properties;
    }

    public static function fromArray(array $data): self
    {
        $properties = null;
        if (isset($data['properties'])) {
            $properties = array_map(
                fn($p) => is_array($p) ? BasketVariationProperty::fromArray($p) : $p,
                $data['properties']
            );
        }

        return new self(
            $data['id'] ?? null,
            $data['stock'] ?? null,
            $data['price'] ?? null,
            $data['primary_price'] ?? null,
            $properties
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->id !== null) $result['id'] = $this->id;
        if ($this->stock !== null) $result['stock'] = $this->stock;
        if ($this->price !== null) $result['price'] = $this->price;
        if ($this->primaryPrice !== null) $result['primary_price'] = $this->primaryPrice;
        if ($this->properties !== null) {
            $result['properties'] = array_map(
                fn($p) => $p instanceof BasketVariationProperty ? $p->toArray() : $p,
                $this->properties
            );
        }
        return $result;
    }

    // Getters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function getPrimaryPrice(): ?int
    {
        return $this->primaryPrice;
    }

    public function getProperties(): ?array
    {
        return $this->properties;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}