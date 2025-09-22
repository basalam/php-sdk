<?php

namespace Basalam\Core\Models;

class MarkedTypeResponse implements \JsonSerializable
{
    public ?string $name;
    public ?int $value;
    public ?string $description;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->name = $data['name'] ?? null;
        $model->value = $data['value'] ?? null;
        $model->description = $data['description'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
            'description' => $this->description,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}