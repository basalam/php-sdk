<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Variation model.
 */
class Variation implements JsonSerializable
{
    private int $id;
    private ?array $properties;

    public function __construct(int $id, ?array $properties = null)
    {
        $this->id = $id;
        $this->properties = $properties;
    }

    public static function fromArray(array $data): self
    {
        $properties = null;
        if (isset($data['properties'])) {
            $properties = array_map(
                fn($prop) => VariationProperty::fromArray($prop),
                $data['properties']
            );
        }

        return new self($data['id'], $properties);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'properties' => $this->properties ? array_map(fn($prop) => $prop->toArray(), $this->properties) : null,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}