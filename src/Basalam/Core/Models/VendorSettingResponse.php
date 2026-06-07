<?php

namespace Basalam\Core\Models;

class VendorSettingResponse implements \JsonSerializable
{
    public string $name;
    public ?array $extra_data;
    public bool $is_active;
    public int $order;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->name = $data['name'];
        $model->extra_data = $data['extra_data'] ?? null;
        $model->is_active = $data['is_active'];
        $model->order = $data['order'];
        return $model;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'extra_data' => $this->extra_data,
            'is_active' => $this->is_active,
            'order' => $this->order,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getExtraData(): ?array
    {
        return $this->extra_data;
    }

    public function getIsActive(): bool
    {
        return $this->is_active;
    }

    public function getOrder(): int
    {
        return $this->order;
    }
}
