<?php

namespace Basalam\Core\Models;

class HomeTabSettingsResponse implements \JsonSerializable
{
    public ?string $name;
    public ?int $order;
    public ?bool $is_active;
    public ?array $extra_data;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->name = $data['name'] ?? null;
        $model->order = $data['order'] ?? null;
        $model->is_active = $data['is_active'] ?? null;
        $model->extra_data = $data['extra_data'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'order' => $this->order,
            'is_active' => $this->is_active,
            'extra_data' => $this->extra_data,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}