<?php

namespace Basalam\Core\Models;

class CategoryUnitTypeResponse implements \JsonSerializable
{
    public ?int $id;
    public ?string $title;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->title = $data['title'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}