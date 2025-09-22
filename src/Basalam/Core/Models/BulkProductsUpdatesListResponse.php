<?php

namespace Basalam\Core\Models;

class BulkProductsUpdatesListResponse implements \JsonSerializable
{
    public ?array $data;
    public ?int $total_count;
    public ?int $result_count;
    public ?int $total_page;
    public ?int $page;
    public ?int $per_page;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->data = isset($data['data'])
            ? array_map(fn($item) => BulkProductUpdateItemResponse::fromArray($item), $data['data'])
            : null;
        $model->total_count = $data['total_count'] ?? null;
        $model->result_count = $data['result_count'] ?? null;
        $model->total_page = $data['total_page'] ?? null;
        $model->page = $data['page'] ?? null;
        $model->per_page = $data['per_page'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->data !== null) {
            $result['data'] = array_map(fn($item) => $item->toArray(), $this->data);
        }
        if ($this->total_count !== null) {
            $result['total_count'] = $this->total_count;
        }
        if ($this->result_count !== null) {
            $result['result_count'] = $this->result_count;
        }
        if ($this->total_page !== null) {
            $result['total_page'] = $this->total_page;
        }
        if ($this->page !== null) {
            $result['page'] = $this->page;
        }
        if ($this->per_page !== null) {
            $result['per_page'] = $this->per_page;
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}