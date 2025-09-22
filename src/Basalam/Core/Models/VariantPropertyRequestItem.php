<?php

namespace Basalam\Core\Models;

class VariantPropertyRequestItem implements \JsonSerializable
{
    public string $value;
    public string $property;

    public function __construct(array $data)
    {
        $this->value = $data['value'];
        $this->property = $data['property'];
    }

    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'property' => $this->property,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}