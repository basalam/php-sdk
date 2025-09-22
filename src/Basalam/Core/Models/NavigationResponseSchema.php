<?php

namespace Basalam\Core\Models;

class NavigationResponseSchema implements \JsonSerializable
{
    public ?string $slug;
    public ?string $title;
    public ?array $categoryIds;
    public ?array $parent;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->slug = $data['slug'] ?? null;
        $model->title = $data['title'] ?? null;
        $model->categoryIds = $data['categoryIds'] ?? null;
        $model->parent = $data['parent'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'categoryIds' => $this->categoryIds,
            'parent' => $this->parent,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}