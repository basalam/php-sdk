<?php

namespace Basalam\Core\Models;

class ProductRevisionDataResponse implements \JsonSerializable
{
    public ?string $title;
    public ?string $brief;
    public ?string $description;
    public ?StatusResponse $status;
    public ?CategoryProductResponse $category;
    public ?array $keywords;
    public ?ImageResponse $photo;
    public ?array $photos;
    public ?VideoDetailResponse $video;
    public ?array $product_attribute;
    public ?int $packaged_weight;
    public ?int $net_weight;
    public ?float $net_weight_decimal;
    public ?int $preparation_day;
    public ?int $price;
    public ?int $primary_price;
    public ?int $inventory;
    public ?array $variants;
    public ?bool $is_wholesale;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->title = $data['title'] ?? null;
        $model->brief = $data['brief'] ?? null;
        $model->description = $data['description'] ?? null;
        $model->status = isset($data['status'])
            ? StatusResponse::fromArray($data['status'])
            : null;
        $model->category = isset($data['category'])
            ? CategoryProductResponse::fromArray($data['category'])
            : null;
        $model->keywords = $data['keywords'] ?? null;
        $model->photo = isset($data['photo'])
            ? ImageResponse::fromArray($data['photo'])
            : null;
        $model->photos = isset($data['photos'])
            ? array_map(fn($photo) => ImageResponse::fromArray($photo), $data['photos'])
            : null;
        $model->video = isset($data['video'])
            ? VideoDetailResponse::fromArray($data['video'])
            : null;
        $model->product_attribute = isset($data['product_attribute'])
            ? array_map(fn($attr) => ProductAttributeResponse::fromArray($attr), $data['product_attribute'])
            : null;
        $model->packaged_weight = $data['packaged_weight'] ?? null;
        $model->net_weight = $data['net_weight'] ?? null;
        $model->net_weight_decimal = $data['net_weight_decimal'] ?? null;
        $model->preparation_day = $data['preparation_day'] ?? null;
        $model->price = $data['price'] ?? null;
        $model->primary_price = $data['primary_price'] ?? null;
        $model->inventory = $data['inventory'] ?? null;
        $model->variants = isset($data['variants'])
            ? array_map(fn($variant) => ProductVariantResponse::fromArray($variant), $data['variants'])
            : null;
        $model->is_wholesale = $data['is_wholesale'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'brief' => $this->brief,
            'description' => $this->description,
            'status' => $this->status?->toArray(),
            'category' => $this->category?->toArray(),
            'keywords' => $this->keywords,
            'photo' => $this->photo?->toArray(),
            'photos' => $this->photos ? array_map(fn($photo) => $photo->toArray(), $this->photos) : null,
            'video' => $this->video?->toArray(),
            'product_attribute' => $this->product_attribute ? array_map(fn($attr) => $attr->toArray(), $this->product_attribute) : null,
            'packaged_weight' => $this->packaged_weight,
            'net_weight' => $this->net_weight,
            'net_weight_decimal' => $this->net_weight_decimal,
            'preparation_day' => $this->preparation_day,
            'price' => $this->price,
            'primary_price' => $this->primary_price,
            'inventory' => $this->inventory,
            'variants' => $this->variants ? array_map(fn($variant) => $variant->toArray(), $this->variants) : null,
            'is_wholesale' => $this->is_wholesale,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}