<?php

namespace Basalam\Order\Models;

/**
 * Basket product photo model
 */
class BasketProductPhoto implements \JsonSerializable
{
    private ?int $id;
    private ?string $original;
    private ?array $resized;

    public function __construct(
        ?int    $id = null,
        ?string $original = null,
        ?array  $resized = null
    )
    {
        $this->id = $id;
        $this->original = $original;
        $this->resized = $resized;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['original'] ?? null,
            $data['resized'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->id !== null) $result['id'] = $this->id;
        if ($this->original !== null) $result['original'] = $this->original;
        if ($this->resized !== null) $result['resized'] = $this->resized;
        return $result;
    }

    // Getters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOriginal(): ?string
    {
        return $this->original;
    }

    public function getResized(): ?array
    {
        return $this->resized;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}