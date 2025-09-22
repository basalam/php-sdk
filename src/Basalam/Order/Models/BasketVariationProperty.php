<?php

namespace Basalam\Order\Models;

/**
 * Basket variation property model
 */
class BasketVariationProperty implements \JsonSerializable
{
    private ?array $property;
    private ?array $value;

    public function __construct(?array $property = null, ?array $value = null)
    {
        $this->property = $property;
        $this->value = $value;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['property'] ?? null,
            $data['value'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->property !== null) $result['property'] = $this->property;
        if ($this->value !== null) $result['value'] = $this->value;
        return $result;
    }

    // Getters

    public function getProperty(): ?array
    {
        return $this->property;
    }

    public function getValue(): ?array
    {
        return $this->value;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}