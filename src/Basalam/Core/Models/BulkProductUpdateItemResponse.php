<?php

namespace Basalam\Core\Models;

class BulkProductUpdateItemResponse implements \JsonSerializable
{
    public ?int $id;
    public ?int $successful_count;
    public ?int $unsuccessful_count;
    public ?string $ended_at;
    public ?array $unsuccessful_products;
    public ?array $status;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->successful_count = $data['successful_count'] ?? null;
        $model->unsuccessful_count = $data['unsuccessful_count'] ?? null;
        $model->ended_at = $data['ended_at'] ?? null;
        $model->unsuccessful_products = $data['unsuccessful_products'] ?? null;
        $model->status = $data['status'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->id !== null) {
            $result['id'] = $this->id;
        }
        if ($this->successful_count !== null) {
            $result['successful_count'] = $this->successful_count;
        }
        if ($this->unsuccessful_count !== null) {
            $result['unsuccessful_count'] = $this->unsuccessful_count;
        }
        if ($this->ended_at !== null) {
            $result['ended_at'] = $this->ended_at;
        }
        if ($this->unsuccessful_products !== null) {
            $result['unsuccessful_products'] = $this->unsuccessful_products;
        }
        if ($this->status !== null) {
            $result['status'] = $this->status;
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}