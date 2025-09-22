<?php

namespace Basalam\Core\Models;

class PrivateVendorResponse implements \JsonSerializable
{
    public ?int $id;
    public ?string $name;
    public ?string $description;
    public ?string $logo;
    public ?string $cover;
    public ?string $mobile;
    public ?string $email;
    public ?string $address;
    public ?int $city_id;
    public array $settings;
    public ?VendorLegalDataSchema $legal_data;
    public ?string $created_at;
    public ?string $updated_at;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->name = $data['name'] ?? null;
        $model->description = $data['description'] ?? null;
        // Handle logo which might be an array or string
        if (isset($data['logo'])) {
            $model->logo = is_array($data['logo']) ? json_encode($data['logo']) : $data['logo'];
        } else {
            $model->logo = null;
        }

        // Handle cover which might be an array or string
        if (isset($data['cover'])) {
            $model->cover = is_array($data['cover']) ? json_encode($data['cover']) : $data['cover'];
        } else {
            $model->cover = null;
        }
        $model->mobile = $data['mobile'] ?? null;
        $model->email = $data['email'] ?? null;
        $model->address = $data['address'] ?? null;
        $model->city_id = $data['city_id'] ?? null;
        $model->settings = isset($data['settings'])
            ? array_map(fn($setting) => VendorSettingResponse::fromArray($setting), $data['settings'])
            : [];
        $model->legal_data = isset($data['legal_data'])
            ? new VendorLegalDataSchema($data['legal_data'])
            : null;
        $model->created_at = $data['created_at'] ?? null;
        $model->updated_at = $data['updated_at'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'logo' => $this->logo,
            'cover' => $this->cover,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'address' => $this->address,
            'city_id' => $this->city_id,
            'settings' => array_map(fn($setting) => $setting->toArray(), $this->settings),
            'legal_data' => $this->legal_data?->toArray(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}