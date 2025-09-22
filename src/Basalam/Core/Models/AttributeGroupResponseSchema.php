<?php

namespace Basalam\Core\Models;

class AttributeGroupResponseSchema implements \JsonSerializable
{
    public ?string $title;
    public ?array $attributes;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->title = $data['title'] ?? null;
        $model->attributes = isset($data['attributes'])
            ? array_map(fn($attr) => ProductAttributeResponse::fromArray($attr), $data['attributes'])
            : null;
        return $model;
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->title !== null) {
            $result['title'] = $this->title;
        }

        if ($this->attributes !== null) {
            $result['attributes'] = array_map(fn($attr) => $attr->toArray(), $this->attributes);
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}