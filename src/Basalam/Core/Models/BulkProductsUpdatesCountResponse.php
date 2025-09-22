<?php

namespace Basalam\Core\Models;

class BulkProductsUpdatesCountResponse implements \JsonSerializable
{
    public ?int $remove_discounts_requests_count;
    public ?int $apply_discount_requests_count;
    public ?int $bulk_action_requests_count;
    public ?int $sum;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->remove_discounts_requests_count = $data['remove_discounts_requests_count'] ?? null;
        $model->apply_discount_requests_count = $data['apply_discount_requests_count'] ?? null;
        $model->bulk_action_requests_count = $data['bulk_action_requests_count'] ?? null;
        $model->sum = $data['sum'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->remove_discounts_requests_count !== null) {
            $result['remove_discounts_requests_count'] = $this->remove_discounts_requests_count;
        }
        if ($this->apply_discount_requests_count !== null) {
            $result['apply_discount_requests_count'] = $this->apply_discount_requests_count;
        }
        if ($this->bulk_action_requests_count !== null) {
            $result['bulk_action_requests_count'] = $this->bulk_action_requests_count;
        }
        if ($this->sum !== null) {
            $result['sum'] = $this->sum;
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}