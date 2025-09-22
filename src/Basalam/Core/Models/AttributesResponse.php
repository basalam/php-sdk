<?php

namespace Basalam\Core\Models;

class AttributesResponse implements \JsonSerializable
{
    public array $data;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->data = isset($data['data'])
            ? array_map(fn($group) => AttributeGroupResponseSchema::fromArray($group), $data['data'])
            : [];
        return $model;
    }

    public function toArray(): array
    {
        return [
            'data' => array_map(fn($group) => $group->toArray(), $this->data)
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}