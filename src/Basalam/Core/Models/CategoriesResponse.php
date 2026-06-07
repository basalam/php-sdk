<?php

namespace Basalam\Core\Models;

class CategoriesResponse implements \JsonSerializable
{
    public ?array $data;

    public static function fromArray(array $data): self
    {
        // Some gateway responses wrap the payload in a "response" envelope,
        // occasionally as a JSON-encoded string. Unwrap it transparently so the
        // categories list is parsed regardless of the envelope shape.
        if (!isset($data['data']) && isset($data['response'])) {
            $inner = $data['response'];
            if (is_string($inner)) {
                $decoded = json_decode($inner, true);
                if (is_array($decoded)) {
                    $data = $decoded;
                }
            } elseif (is_array($inner)) {
                $data = $inner;
            }
        }

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