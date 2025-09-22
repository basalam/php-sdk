<?php

namespace Basalam\Core\Models;

class ProductItemResponse implements \JsonSerializable
{
    public ?int $id;
    public ?string $title;
    public ?int $price;
    public ?ImageResponse $photo;
    public ?array $photos;
    public ?VideoDetailResponse $video;
    public ?StatusResponse $status;
    public ?PublicVendorResponse $vendor;
    public ?string $summary;
    public ?CategoryProductResponse $category;
    public ?int $inventory;
    public ?int $net_weight;
    public ?string $created_at;
    public ?string $updated_at;
    public ?string $description;
    public ?int $primary_price;
    public ?int $packaged_weight;
    public ?int $preparation_day;
    public ?float $net_weight_decimal;
    public ?LocationDeploymentResponseSchema $location_deployment;
    public ?string $url;
    public ?bool $published;
    public ?int $sales_count;
    public ?int $view_count;
    public ?bool $can_add_to_cart;
    public ?bool $has_variation;
    public ?float $unit_quantity;
    public ?UnitTypeResponse $unit_type;
    public ?array $discount;
    public ?bool $is_product_for_revision;
    public ?ProductRevisionResponse $revision;
    public ?ShippingDataResponse $shipping_data;
    public ?array $variant;
    public ?string $sku;
    public ?bool $is_wholesale;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->title = $data['title'] ?? null;
        $model->price = $data['price'] ?? null;
        $model->photo = isset($data['photo'])
            ? ImageResponse::fromArray($data['photo'])
            : null;
        $model->photos = isset($data['photos'])
            ? array_map(fn($photo) => ImageResponse::fromArray($photo), $data['photos'])
            : null;
        $model->video = isset($data['video'])
            ? VideoDetailResponse::fromArray($data['video'])
            : null;
        $model->status = isset($data['status'])
            ? StatusResponse::fromArray($data['status'])
            : null;
        $model->vendor = isset($data['vendor'])
            ? PublicVendorResponse::fromArray($data['vendor'])
            : null;
        $model->summary = $data['summary'] ?? null;
        $model->category = isset($data['category'])
            ? CategoryProductResponse::fromArray($data['category'])
            : null;
        $model->inventory = $data['inventory'] ?? null;
        $model->net_weight = $data['net_weight'] ?? null;
        $model->created_at = $data['created_at'] ?? null;
        $model->updated_at = $data['updated_at'] ?? null;
        $model->description = $data['description'] ?? null;
        $model->primary_price = $data['primary_price'] ?? null;
        $model->packaged_weight = $data['packaged_weight'] ?? null;
        $model->preparation_day = $data['preparation_day'] ?? null;
        $model->net_weight_decimal = $data['net_weight_decimal'] ?? null;
        $model->location_deployment = isset($data['location_deployment'])
            ? LocationDeploymentResponseSchema::fromArray($data['location_deployment'])
            : null;
        $model->url = $data['url'] ?? null;
        $model->published = $data['published'] ?? null;
        $model->sales_count = $data['sales_count'] ?? null;
        $model->view_count = $data['view_count'] ?? null;
        $model->can_add_to_cart = $data['can_add_to_cart'] ?? null;
        $model->has_variation = $data['has_variation'] ?? null;
        $model->unit_quantity = $data['unit_quantity'] ?? null;
        $model->unit_type = isset($data['unit_type'])
            ? UnitTypeResponse::fromArray($data['unit_type'])
            : null;
        $model->discount = $data['discount'] ?? null;
        $model->is_product_for_revision = $data['is_product_for_revision'] ?? null;
        $model->revision = isset($data['revision'])
            ? ProductRevisionResponse::fromArray($data['revision'])
            : null;
        $model->shipping_data = isset($data['shipping_data'])
            ? ShippingDataResponse::fromArray($data['shipping_data'])
            : null;
        $model->variant = isset($data['variant'])
            ? array_map(fn($v) => ProductVariantResponse::fromArray($v), $data['variant'])
            : null;
        $model->sku = $data['sku'] ?? null;
        $model->is_wholesale = $data['is_wholesale'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->id !== null) $result['id'] = $this->id;
        if ($this->title !== null) $result['title'] = $this->title;
        if ($this->price !== null) $result['price'] = $this->price;
        if ($this->photo !== null) $result['photo'] = $this->photo->toArray();
        if ($this->photos !== null) {
            $result['photos'] = array_map(fn($photo) => $photo->toArray(), $this->photos);
        }
        if ($this->video !== null) $result['video'] = $this->video->toArray();
        if ($this->status !== null) $result['status'] = $this->status->toArray();
        if ($this->vendor !== null) $result['vendor'] = $this->vendor->toArray();
        if ($this->summary !== null) $result['summary'] = $this->summary;
        if ($this->category !== null) $result['category'] = $this->category->toArray();
        if ($this->inventory !== null) $result['inventory'] = $this->inventory;
        if ($this->net_weight !== null) $result['net_weight'] = $this->net_weight;
        if ($this->created_at !== null) $result['created_at'] = $this->created_at;
        if ($this->updated_at !== null) $result['updated_at'] = $this->updated_at;
        if ($this->description !== null) $result['description'] = $this->description;
        if ($this->primary_price !== null) $result['primary_price'] = $this->primary_price;
        if ($this->packaged_weight !== null) $result['packaged_weight'] = $this->packaged_weight;
        if ($this->preparation_day !== null) $result['preparation_day'] = $this->preparation_day;
        if ($this->net_weight_decimal !== null) $result['net_weight_decimal'] = $this->net_weight_decimal;
        if ($this->location_deployment !== null) $result['location_deployment'] = $this->location_deployment->toArray();
        if ($this->url !== null) $result['url'] = $this->url;
        if ($this->published !== null) $result['published'] = $this->published;
        if ($this->sales_count !== null) $result['sales_count'] = $this->sales_count;
        if ($this->view_count !== null) $result['view_count'] = $this->view_count;
        if ($this->can_add_to_cart !== null) $result['can_add_to_cart'] = $this->can_add_to_cart;
        if ($this->has_variation !== null) $result['has_variation'] = $this->has_variation;
        if ($this->unit_quantity !== null) $result['unit_quantity'] = $this->unit_quantity;
        if ($this->unit_type !== null) $result['unit_type'] = $this->unit_type->toArray();
        if ($this->discount !== null) $result['discount'] = $this->discount;
        if ($this->is_product_for_revision !== null) $result['is_product_for_revision'] = $this->is_product_for_revision;
        if ($this->revision !== null) $result['revision'] = $this->revision->toArray();
        if ($this->shipping_data !== null) $result['shipping_data'] = $this->shipping_data->toArray();
        if ($this->variant !== null) {
            $result['variant'] = array_map(fn($v) => $v->toArray(), $this->variant);
        }
        if ($this->sku !== null) $result['sku'] = $this->sku;
        if ($this->is_wholesale !== null) $result['is_wholesale'] = $this->is_wholesale;

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}