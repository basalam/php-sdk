<?php

namespace Basalam\Core\Models;

class ProductShelfResponse implements \JsonSerializable
{
    public ?int $id;
    public ?string $title;
    public ?string $description;
    public ?int $vendor_id;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->title = $data['title'] ?? null;
        $model->description = $data['description'] ?? null;
        $model->vendor_id = $data['vendor_id'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'vendor_id' => $this->vendor_id,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}