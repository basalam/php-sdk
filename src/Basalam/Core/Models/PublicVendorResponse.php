<?php

namespace Basalam\Core\Models;

class PublicVendorResponse implements \JsonSerializable
{
    public ?int $id;
    public ?string $identifier;
    public ?string $title;
    public ?ImageResponse $logo;
    public ?array $covers;
    public ?array $available_cities;
    public ?string $summary;
    public ?StatusResponse $status;
    public ?CityResponse $city;
    public ?array $category_type;
    public ?PublicUserResponse $user;
    public ?bool $is_active;
    public ?string $notice;
    public ?array $gallery;
    public ?int $product_count;
    public ?int $free_shipping_to_iran;
    public ?int $free_shipping_to_same_city;
    public ?string $about_your_life;
    public ?string $about_your_place;
    public ?string $worth_buy;
    public ?string $telegram_id;
    public ?string $telegram_channel;
    public ?string $instagram;
    public ?string $eitaa;
    public ?int $order_count;
    public ?string $last_activity;
    public ?string $created_at;
    public ?string $elapsed_time_from_creation;
    public ?float $score;
    public ?VideoDetailResponse $video;
    public ?array $shipping_methods;
    public ?ProductSortTypeResponse $product_sort_type;
    public ?array $home_tab_settings;
    public ?int $shipping_version;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->identifier = $data['identifier'] ?? null;
        $model->title = $data['title'] ?? null;
        $model->logo = isset($data['logo'])
            ? ImageResponse::fromArray($data['logo'])
            : null;
        $model->covers = isset($data['covers'])
            ? array_map(fn($cover) => ImageResponse::fromArray($cover), $data['covers'])
            : null;
        $model->available_cities = isset($data['available_cities'])
            ? array_map(fn($city) => CityResponse::fromArray($city), $data['available_cities'])
            : null;
        $model->summary = $data['summary'] ?? null;
        $model->status = isset($data['status'])
            ? StatusResponse::fromArray($data['status'])
            : null;
        $model->city = isset($data['city'])
            ? CityResponse::fromArray($data['city'])
            : null;
        $model->category_type = isset($data['category_type'])
            ? array_map(fn($cat) => $cat ? CategoryTypeResponse::fromArray($cat) : null, $data['category_type'])
            : null;
        $model->user = isset($data['user'])
            ? PublicUserResponse::fromArray($data['user'])
            : null;
        $model->is_active = $data['is_active'] ?? null;
        $model->notice = $data['notice'] ?? null;
        $model->gallery = isset($data['gallery'])
            ? array_map(fn($img) => ImageResponse::fromArray($img), $data['gallery'])
            : null;
        $model->product_count = $data['product_count'] ?? null;
        $model->free_shipping_to_iran = $data['free_shipping_to_iran'] ?? null;
        $model->free_shipping_to_same_city = $data['free_shipping_to_same_city'] ?? null;
        $model->about_your_life = $data['about_your_life'] ?? null;
        $model->about_your_place = $data['about_your_place'] ?? null;
        $model->worth_buy = $data['worth_buy'] ?? null;
        $model->telegram_id = $data['telegram_id'] ?? null;
        $model->telegram_channel = $data['telegram_channel'] ?? null;
        $model->instagram = $data['instagram'] ?? null;
        $model->eitaa = $data['eitaa'] ?? null;
        $model->order_count = $data['order_count'] ?? null;
        $model->last_activity = $data['last_activity'] ?? null;
        $model->created_at = $data['created_at'] ?? null;
        $model->elapsed_time_from_creation = $data['elapsed_time_from_creation'] ?? null;
        $model->score = $data['score'] ?? null;
        $model->video = isset($data['video'])
            ? VideoDetailResponse::fromArray($data['video'])
            : null;
        $model->shipping_methods = isset($data['shipping_methods'])
            ? array_map(fn($method) => ShippingMethodItemResponse::fromArray($method), $data['shipping_methods'])
            : null;
        $model->product_sort_type = isset($data['product_sort_type'])
            ? ProductSortTypeResponse::fromArray($data['product_sort_type'])
            : null;
        $model->home_tab_settings = isset($data['home_tab_settings'])
            ? array_map(fn($setting) => HomeTabSettingsResponse::fromArray($setting), $data['home_tab_settings'])
            : null;
        $model->shipping_version = $data['shipping_version'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'identifier' => $this->identifier,
            'title' => $this->title,
            'logo' => $this->logo?->toArray(),
            'covers' => $this->covers ? array_map(fn($cover) => $cover->toArray(), $this->covers) : null,
            'available_cities' => $this->available_cities ? array_map(fn($city) => $city->toArray(), $this->available_cities) : null,
            'summary' => $this->summary,
            'status' => $this->status?->toArray(),
            'city' => $this->city?->toArray(),
            'category_type' => $this->category_type ? array_map(fn($cat) => $cat?->toArray(), $this->category_type) : null,
            'user' => $this->user?->toArray(),
            'is_active' => $this->is_active,
            'notice' => $this->notice,
            'gallery' => $this->gallery ? array_map(fn($img) => $img->toArray(), $this->gallery) : null,
            'product_count' => $this->product_count,
            'free_shipping_to_iran' => $this->free_shipping_to_iran,
            'free_shipping_to_same_city' => $this->free_shipping_to_same_city,
            'about_your_life' => $this->about_your_life,
            'about_your_place' => $this->about_your_place,
            'worth_buy' => $this->worth_buy,
            'telegram_id' => $this->telegram_id,
            'telegram_channel' => $this->telegram_channel,
            'instagram' => $this->instagram,
            'eitaa' => $this->eitaa,
            'order_count' => $this->order_count,
            'last_activity' => $this->last_activity,
            'created_at' => $this->created_at,
            'elapsed_time_from_creation' => $this->elapsed_time_from_creation,
            'score' => $this->score,
            'video' => $this->video?->toArray(),
            'shipping_methods' => $this->shipping_methods ? array_map(fn($method) => $method->toArray(), $this->shipping_methods) : null,
            'product_sort_type' => $this->product_sort_type?->toArray(),
            'home_tab_settings' => $this->home_tab_settings ? array_map(fn($setting) => $setting->toArray(), $this->home_tab_settings) : null,
            'shipping_version' => $this->shipping_version,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}