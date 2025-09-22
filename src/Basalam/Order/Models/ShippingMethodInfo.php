<?php

namespace Basalam\Order\Models;

/**
 * Shipping method information
 */
class ShippingMethodInfo implements \JsonSerializable
{
    private ?int $id;
    private ?string $title;
    private ?array $parent;

    public function __construct(
        ?int    $id = null,
        ?string $title = null,
        ?array  $parent = null
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->parent = $parent;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['title'] ?? null,
            $data['parent'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->id !== null) $result['id'] = $this->id;
        if ($this->title !== null) $result['title'] = $this->title;
        if ($this->parent !== null) $result['parent'] = $this->parent;
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

    public function getParent(): ?array
    {
        return $this->parent;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}