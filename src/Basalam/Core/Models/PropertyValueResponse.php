<?php

namespace Basalam\Core\Models;

class PropertyValueResponse implements \JsonSerializable
{
    public ?int $id;
    public ?string $title;
    public ?string $value;
    public ?int $order;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->title = $data['title'] ?? null;
        $model->value = $data['value'] ?? null;
        $model->order = $data['order'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'value' => $this->value,
            'order' => $this->order,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}