<?php

namespace Basalam\Core\Models;

class CreateVendorSchema implements \JsonSerializable
{
    public string $title;
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
    public ?VendorLegalRequestSchema $legal_data;
    public string $identifier;
    public ?string $referrer_user;
    public ?int $referral_journey_enum;

    public function __construct(array $data)
    {
        $this->title = $data['title'];
        $this->identifier = $data['identifier'];
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
            ? new VendorLegalRequestSchema($data['legal_data'])
            : null;
        $this->referrer_user = $data['referrer_user'] ?? null;
        $this->referral_journey_enum = $data['referral_journey_enum'] ?? null;
    }

    public function toArray(): array
    {
        $result = [
            'title' => $this->title,
            'identifier' => $this->identifier,
        ];

        if ($this->category_type !== null) $result['category_type'] = $this->category_type;
        if ($this->city !== null) $result['city'] = $this->city;
        if ($this->notice !== null) $result['notice'] = $this->notice;
        if ($this->summary !== null) $result['summary'] = $this->summary;
        if ($this->address !== null) $result['address'] = $this->address;
        if ($this->postal_code !== null) $result['postal_code'] = $this->postal_code;
        if ($this->secondary_tel !== null) $result['secondary_tel'] = $this->secondary_tel;
        if ($this->logo_id !== null) $result['logo_id'] = $this->logo_id;
        if ($this->covers_id !== null) $result['covers_id'] = $this->covers_id;
        if ($this->licenses !== null) $result['licenses'] = $this->licenses;
        if ($this->video_id !== null) $result['video_id'] = $this->video_id;
        if ($this->legal_data !== null) $result['legal_data'] = $this->legal_data->toArray();
        if ($this->referrer_user !== null) $result['referrer_user'] = $this->referrer_user;
        if ($this->referral_journey_enum !== null) $result['referral_journey_enum'] = $this->referral_journey_enum;

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}