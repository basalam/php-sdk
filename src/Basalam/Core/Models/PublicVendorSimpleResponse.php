<?php

namespace Basalam\Core\Models;

class PublicVendorSimpleResponse implements \JsonSerializable
{
    public ?int $id;
    public ?string $identifier;
    public ?string $title;
    public ?string $description;
    public ?bool $is_active;
    public ?int $free_shipping_to_iran;
    public ?int $free_shipping_to_same_city;
    public ?string $worth_buy;
    public ?string $created_at;
    public ?string $activated_at;
    public ?int $order_count;
    public ?int $status;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->identifier = $data['identifier'] ?? null;
        $model->title = $data['title'] ?? null;
        $model->description = $data['description'] ?? null;
        $model->is_active = $data['is_active'] ?? null;
        $model->free_shipping_to_iran = $data['free_shipping_to_iran'] ?? null;
        $model->free_shipping_to_same_city = $data['free_shipping_to_same_city'] ?? null;
        $model->worth_buy = $data['worth_buy'] ?? null;
        $model->created_at = $data['created_at'] ?? null;
        $model->activated_at = $data['activated_at'] ?? null;
        $model->order_count = $data['order_count'] ?? null;
        $model->status = $data['status'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'identifier' => $this->identifier,
            'title' => $this->title,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'free_shipping_to_iran' => $this->free_shipping_to_iran,
            'free_shipping_to_same_city' => $this->free_shipping_to_same_city,
            'worth_buy' => $this->worth_buy,
            'created_at' => $this->created_at,
            'activated_at' => $this->activated_at,
            'order_count' => $this->order_count,
            'status' => $this->status,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}