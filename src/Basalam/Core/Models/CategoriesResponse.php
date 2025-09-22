<?php

namespace Basalam\Core\Models;

class CategoriesResponse implements \JsonSerializable
{
    public ?array $data;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->data = isset($data['data'])
            ? array_map(fn($cat) => CategoryResponse::fromArray($cat), $data['data'])
            : null;
        return $model;
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->data !== null) {
            $result['data'] = array_map(fn($cat) => $cat->toArray(), $this->data);
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}