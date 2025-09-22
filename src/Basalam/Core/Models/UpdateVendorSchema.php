<?php

namespace Basalam\Core\Models;

class UpdateVendorSchema implements \JsonSerializable
{
    public ?string $title;
    public ?int $category_type;
    public ?int $city;
    public ?string $notice;
    public ?string $summary;
    public ?string $address;
    public ?string $postal_code;
    public ?string $secondary_tel;
    public ?int $logo_id;
    public ?array $covers_id;
    public ?array $licenses;
    public ?int $video_id;
    public ?VendorLegalDataSchema $legal_data;
    public ?string $about_your_life;
    public ?string $about_your_place;
    public ?int $free_shipping_to_same_city;
    public ?int $free_shipping_to_iran;
    public ?string $national_code;
    public ?string $birthday;
    public ?string $telegram_id;
    public ?string $telegram_channel;
    public ?string $instagram;
    public ?string $eitaa;
    public ?string $email;
    public ?string $credit_card_number;
    public ?string $sheba_number;
    public ?string $sheba_owner;
    public ?int $sheba_bank;
    public ?array $available_cities;
    public ?string $foreign_citizen_code;
    public ?string $mobile;
    public ?int $product_sort_type;
    public ?string $identifier;
    public ?int $info_verification_status;

    public function __construct(array $data = [])
    {
        $this->title = $data['title'] ?? null;
        $this->category_type = $data['category_type'] ?? null;
        $this->city = $data['city'] ?? null;
        $this->notice = $data['notice'] ?? null;
        $this->summary = $data['summary'] ?? null;
        $this->address = $data['address'] ?? null;
        $this->postal_code = $data['postal_code'] ?? null;
        $this->secondary_tel = $data['secondary_tel'] ?? null;
        $this->logo_id = $data['logo_id'] ?? null;
        $this->covers_id = $data['covers_id'] ?? null;
        $this->licenses = $data['licenses'] ?? null;
        $this->video_id = $data['video_id'] ?? null;
        $this->legal_data = isset($data['legal_data'])
            ? new VendorLegalDataSchema($data['legal_data'])
            : null;
        $this->about_your_life = $data['about_your_life'] ?? null;
        $this->about_your_place = $data['about_your_place'] ?? null;
        $this->free_shipping_to_same_city = $data['free_shipping_to_same_city'] ?? null;
        $this->free_shipping_to_iran = $data['free_shipping_to_iran'] ?? null;
        $this->national_code = $data['national_code'] ?? null;
        $this->birthday = $data['birthday'] ?? null;
        $this->telegram_id = $data['telegram_id'] ?? null;
        $this->telegram_channel = $data['telegram_channel'] ?? null;
        $this->instagram = $data['instagram'] ?? null;
        $this->eitaa = $data['eitaa'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->credit_card_number = $data['credit_card_number'] ?? null;
        $this->sheba_number = $data['sheba_number'] ?? null;
        $this->sheba_owner = $data['sheba_owner'] ?? null;
        $this->sheba_bank = $data['sheba_bank'] ?? null;
        $this->available_cities = $data['available_cities'] ?? null;
        $this->foreign_citizen_code = $data['foreign_citizen_code'] ?? null;
        $this->mobile = $data['mobile'] ?? null;
        $this->product_sort_type = $data['product_sort_type'] ?? null;
        $this->identifier = $data['identifier'] ?? null;
        $this->info_verification_status = $data['info_verification_status'] ?? null;
    }

    public function toArray(): array
    {
        $result = [];

        foreach (get_object_vars($this) as $key => $value) {
            if ($value !== null) {
                if ($key === 'legal_data' && $value instanceof VendorLegalDataSchema) {
                    $result[$key] = $value->toArray();
                } else {
                    $result[$key] = $value;
                }
            }
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}