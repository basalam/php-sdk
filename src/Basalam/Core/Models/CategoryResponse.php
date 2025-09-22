<?php

namespace Basalam\Core\Models;

class CategoryResponse implements \JsonSerializable
{
    public ?int $id;
    public ?string $title;
    public ?array $children;
    public ?CategoryUnitTypeResponse $unit_type;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->title = $data['title'] ?? null;
        $model->children = isset($data['children'])
            ? array_map(fn($child) => self::fromArray($child), $data['children'])
            : null;
        $model->unit_type = isset($data['unit_type'])
            ? CategoryUnitTypeResponse::fromArray($data['unit_type'])
            : null;
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
        if ($this->children !== null) {
            $result['children'] = array_map(fn($child) => $child->toArray(), $this->children);
        }
        if ($this->unit_type !== null) {
            $result['unit_type'] = $this->unit_type->toArray();
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}