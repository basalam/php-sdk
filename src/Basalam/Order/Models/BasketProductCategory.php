<?php

namespace Basalam\Order\Models;

/**
 * Basket product category model
 */
class BasketProductCategory implements \JsonSerializable
{
    private ?int $id;
    private ?string $title;

    public function __construct(?int $id = null, ?string $title = null)
    {
        $this->id = $id;
        $this->title = $title;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['title'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->id !== null) $result['id'] = $this->id;
        if ($this->title !== null) $result['title'] = $this->title;
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

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}