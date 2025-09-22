<?php

namespace Basalam\Core\Models;

class CategoryListItemResponseSchema implements \JsonSerializable
{
    public ?int $id;
    public ?string $title;
    public ?string $slug;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->title = $data['title'] ?? null;
        $model->slug = $data['slug'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->id !== null) {
            $result['id'] = $this->id;
        }
        if ($this->title !== null) {
            $result['title'] = $this->title;
        }
        if ($this->slug !== null) {
            $result['slug'] = $this->slug;
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}