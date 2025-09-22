<?php

namespace Basalam\Core\Models;

class CategoryProductResponse implements \JsonSerializable
{
    public ?int $id;
    public ?string $title;
    public ?string $placeholder;
    public ?array $parent;
    public ?StatusResponse $unit_type_id;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->title = $data['title'] ?? null;
        $model->placeholder = $data['placeholder'] ?? null;
        $model->parent = $data['parent'] ?? null;
        $model->unit_type_id = isset($data['unit_type_id'])
            ? StatusResponse::fromArray($data['unit_type_id'])
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
        if ($this->placeholder !== null) {
            $result['placeholder'] = $this->placeholder;
        }
        if ($this->parent !== null) {
            $result['parent'] = $this->parent;
        }
        if ($this->unit_type_id !== null) {
            $result['unit_type_id'] = $this->unit_type_id->toArray();
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}