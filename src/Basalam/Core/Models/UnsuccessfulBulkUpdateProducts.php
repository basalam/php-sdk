<?php

namespace Basalam\Core\Models;

class UnsuccessfulBulkUpdateProducts implements \JsonSerializable
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
            ? array_map(fn($item) => UnsuccessfulProductItem::fromArray($item), $data['data'])
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
        return [
            'data' => $this->data !== null
                ? array_map(fn($item) => $item->toArray(), $this->data)
                : null,
            'total_count' => $this->total_count,
            'result_count' => $this->result_count,
            'total_page' => $this->total_page,
            'page' => $this->page,
            'per_page' => $this->per_page,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}