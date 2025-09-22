<?php

namespace Basalam\Core\Models;

class CityResponse implements \JsonSerializable
{
    public ?string $name;
    public ?int $value;
    public ?ProvinceResponse $province;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->name = $data['name'] ?? null;
        $model->value = $data['value'] ?? null;
        $model->province = isset($data['province'])
            ? ProvinceResponse::fromArray($data['province'])
            : null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
            'province' => $this->province?->toArray(),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}