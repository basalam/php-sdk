<?php

namespace Basalam\Core\Models;

class ProductAttributeResponse implements \JsonSerializable
{
    public ?int $id;
    public ?string $unit;
    public ?StatusResponse $type;
    public ?string $title;
    public ?string $value;
    public ?array $selected_values;
    public ?bool $required;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->unit = $data['unit'] ?? null;
        $model->type = isset($data['type'])
            ? StatusResponse::fromArray($data['type'])
            : null;
        $model->title = $data['title'] ?? null;
        $model->value = $data['value'] ?? null;
        $model->selected_values = isset($data['selected_values'])
            ? array_map(fn($val) => ProductAttributeValueResponse::fromArray($val), $data['selected_values'])
            : null;
        $model->required = $data['required'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'unit' => $this->unit,
            'type' => $this->type?->toArray(),
            'title' => $this->title,
            'value' => $this->value,
            'selected_values' => $this->selected_values ? array_map(fn($val) => $val->toArray(), $this->selected_values) : null,
            'required' => $this->required,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}