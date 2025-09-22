<?php

namespace Basalam\Core\Models;

class VariantPropertyResponse implements \JsonSerializable
{
    public ?PropertyResponse $property;
    public ?PropertyValueResponse $value;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->property = isset($data['property'])
            ? PropertyResponse::fromArray($data['property'])
            : null;
        $model->value = isset($data['value'])
            ? PropertyValueResponse::fromArray($data['value'])
            : null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'property' => $this->property?->toArray(),
            'value' => $this->value?->toArray(),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}