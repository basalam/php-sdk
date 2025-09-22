<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Variation property model.
 */
class VariationProperty implements JsonSerializable
{
    private Property $property;
    private PropertyValue $value;

    public function __construct(Property $property, PropertyValue $value)
    {
        $this->property = $property;
        $this->value = $value;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            Property::fromArray($data['property']),
            PropertyValue::fromArray($data['value'])
        );
    }

    public function toArray(): array
    {
        return [
            'property' => $this->property->toArray(),
            'value' => $this->value->toArray(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}