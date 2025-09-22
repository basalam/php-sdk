<?php

namespace Basalam\Core\Models;

class FreeShippingResponseSchema implements \JsonSerializable
{
    public ?bool $result;
    public ?array $meta_data;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->result = $data['result'] ?? null;
        $model->meta_data = $data['meta_data'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'result' => $this->result,
            'meta_data' => $this->meta_data,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}