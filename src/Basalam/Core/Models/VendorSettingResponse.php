<?php

namespace Basalam\Core\Models;

class VendorSettingResponse implements \JsonSerializable
{
    public int $id;
    public int $vendor_id;
    public string $setting_key;
    public string $setting_value;
    public ?string $created_at;
    public ?string $updated_at;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'];
        $model->vendor_id = $data['vendor_id'];
        $model->setting_key = $data['setting_key'];
        $model->setting_value = $data['setting_value'];
        $model->created_at = $data['created_at'] ?? null;
        $model->updated_at = $data['updated_at'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'vendor_id' => $this->vendor_id,
            'setting_key' => $this->setting_key,
            'setting_value' => $this->setting_value,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}