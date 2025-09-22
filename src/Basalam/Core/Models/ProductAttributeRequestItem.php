<?php

namespace Basalam\Core\Models;

class ProductAttributeRequestItem implements \JsonSerializable
{
    public int $attribute_id;
    public ?string $value;
    public ?array $selected_values;

    public function __construct(array $data)
    {
        $this->attribute_id = $data['attribute_id'];
        $this->value = $data['value'] ?? null;
        $this->selected_values = $data['selected_values'] ?? null;
    }

    public function toArray(): array
    {
        $result = ['attribute_id' => $this->attribute_id];
        if ($this->value !== null) $result['value'] = $this->value;
        if ($this->selected_values !== null) $result['selected_values'] = $this->selected_values;
        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}