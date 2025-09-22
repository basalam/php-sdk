<?php

namespace Basalam\Core\Models;

class BulkProductsUpdateResponseSchema implements \JsonSerializable
{
    public ?int $id;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->id !== null) {
            $result['id'] = $this->id;
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}