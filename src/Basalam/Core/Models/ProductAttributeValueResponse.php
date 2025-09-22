<?php

namespace Basalam\Core\Models;

class ProductAttributeValueResponse implements \JsonSerializable
{
    public ?int $id;
    public ?string $title;
    public ?string $value;
    public ?int $attribute_id;
    public ?int $order;
    public ?int $vendor_id;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->title = $data['title'] ?? null;
        $model->value = $data['value'] ?? null;
        $model->attribute_id = $data['attribute_id'] ?? null;
        $model->order = $data['order'] ?? null;
        $model->vendor_id = $data['vendor_id'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'value' => $this->value,
            'attribute_id' => $this->attribute_id,
            'order' => $this->order,
            'vendor_id' => $this->vendor_id,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}