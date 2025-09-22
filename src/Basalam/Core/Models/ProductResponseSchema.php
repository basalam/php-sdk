<?php

namespace Basalam\Core\Models;

class ProductResponseSchema implements \JsonSerializable
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
    public ?array $category_list;
    public ?int $inventory;
    public ?int $net_weight;
    public ?float $net_weight_decimal;
    public ?string $created_at;
    public ?string $updated_at;
    public ?string $description;
    public ?bool $is_saleable;
    public ?bool $is_showable;
    public ?bool $is_available;
    public ?int $primary_price;
    public ?array $shipping_area;
    public ?int $packaged_weight;
    public ?int $preparation_day;
    public ?array $attribute_groups;
    public ?bool $is_free_shipping;
    public ?LocationDeploymentResponseSchema $location_deployment;
    public ?bool $is_product_for_revision;
    public ?bool $has_selectable_variation;
    public ?ProductRevisionResponse $revision;
    public ?int $view_count;
    public ?bool $can_add_to_cart;
    public ?int $review_count;
    public ?int $rating;
    public ?NavigationResponseSchema $navigation;
    public ?array $variants;
    public ?int $variants_selected_index;
    public ?ShippingDataResponse $shipping_data;
    public ?FreeShippingResponseSchema $free_shipping;
    public ?bool $allow_category_change;
    public ?float $unit_quantity;
    public ?UnitTypeResponse $unit_type;
    public ?string $sku;
    public ?array $discount;
    public ?PackagingDimensionsResponseSchema $packaging_dimensions;
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
        $model->category_list = isset($data['category_list'])
            ? array_map(fn($cat) => CategoryListItemResponseSchema::fromArray($cat), $data['category_list'])
            : null;
        $model->inventory = $data['inventory'] ?? null;
        $model->net_weight = $data['net_weight'] ?? null;
        $model->net_weight_decimal = $data['net_weight_decimal'] ?? null;
        $model->created_at = $data['created_at'] ?? null;
        $model->updated_at = $data['updated_at'] ?? null;
        $model->description = $data['description'] ?? null;
        $model->is_saleable = $data['is_saleable'] ?? null;
        $model->is_showable = $data['is_showable'] ?? null;
        $model->is_available = $data['is_available'] ?? null;
        $model->primary_price = $data['primary_price'] ?? null;
        $model->shipping_area = isset($data['shipping_area'])
            ? array_map(fn($city) => CityResponse::fromArray($city), $data['shipping_area'])
            : null;
        $model->packaged_weight = $data['packaged_weight'] ?? null;
        $model->preparation_day = $data['preparation_day'] ?? null;
        $model->attribute_groups = isset($data['attribute_groups'])
            ? array_map(fn($group) => AttributeGroupResponseSchema::fromArray($group), $data['attribute_groups'])
            : null;
        $model->is_free_shipping = $data['is_free_shipping'] ?? null;
        $model->location_deployment = isset($data['location_deployment'])
            ? LocationDeploymentResponseSchema::fromArray($data['location_deployment'])
            : null;
        $model->is_product_for_revision = $data['is_product_for_revision'] ?? null;
        $model->has_selectable_variation = $data['has_selectable_variation'] ?? null;
        $model->revision = isset($data['revision'])
            ? ProductRevisionResponse::fromArray($data['revision'])
            : null;
        $model->view_count = $data['view_count'] ?? null;
        $model->can_add_to_cart = $data['can_add_to_cart'] ?? null;
        $model->review_count = $data['review_count'] ?? null;
        $model->rating = $data['rating'] ?? null;
        $model->navigation = isset($data['navigation'])
            ? NavigationResponseSchema::fromArray($data['navigation'])
            : null;
        $model->variants = isset($data['variants'])
            ? array_map(fn($variant) => ProductVariantResponse::fromArray($variant), $data['variants'])
            : null;
        $model->variants_selected_index = $data['variants_selected_index'] ?? null;
        $model->shipping_data = isset($data['shipping_data'])
            ? ShippingDataResponse::fromArray($data['shipping_data'])
            : null;
        $model->free_shipping = isset($data['free_shipping'])
            ? FreeShippingResponseSchema::fromArray($data['free_shipping'])
            : null;
        $model->allow_category_change = $data['allow_category_change'] ?? null;
        $model->unit_quantity = $data['unit_quantity'] ?? null;
        $model->unit_type = isset($data['unit_type'])
            ? UnitTypeResponse::fromArray($data['unit_type'])
            : null;
        $model->sku = $data['sku'] ?? null;
        $model->discount = $data['discount'] ?? null;
        $model->packaging_dimensions = isset($data['packaging_dimensions'])
            ? PackagingDimensionsResponseSchema::fromArray($data['packaging_dimensions'])
            : null;
        $model->is_wholesale = $data['is_wholesale'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'photo' => $this->photo?->toArray(),
            'photos' => $this->photos ? array_map(fn($photo) => $photo->toArray(), $this->photos) : null,
            'video' => $this->video?->toArray(),
            'status' => $this->status?->toArray(),
            'vendor' => $this->vendor?->toArray(),
            'summary' => $this->summary,
            'category' => $this->category?->toArray(),
            'category_list' => $this->category_list ? array_map(fn($cat) => $cat->toArray(), $this->category_list) : null,
            'inventory' => $this->inventory,
            'net_weight' => $this->net_weight,
            'net_weight_decimal' => $this->net_weight_decimal,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'description' => $this->description,
            'is_saleable' => $this->is_saleable,
            'is_showable' => $this->is_showable,
            'is_available' => $this->is_available,
            'primary_price' => $this->primary_price,
            'shipping_area' => $this->shipping_area ? array_map(fn($city) => $city->toArray(), $this->shipping_area) : null,
            'packaged_weight' => $this->packaged_weight,
            'preparation_day' => $this->preparation_day,
            'attribute_groups' => $this->attribute_groups ? array_map(fn($group) => $group->toArray(), $this->attribute_groups) : null,
            'is_free_shipping' => $this->is_free_shipping,
            'location_deployment' => $this->location_deployment?->toArray(),
            'is_product_for_revision' => $this->is_product_for_revision,
            'has_selectable_variation' => $this->has_selectable_variation,
            'revision' => $this->revision?->toArray(),
            'view_count' => $this->view_count,
            'can_add_to_cart' => $this->can_add_to_cart,
            'review_count' => $this->review_count,
            'rating' => $this->rating,
            'navigation' => $this->navigation?->toArray(),
            'variants' => $this->variants ? array_map(fn($variant) => $variant->toArray(), $this->variants) : null,
            'variants_selected_index' => $this->variants_selected_index,
            'shipping_data' => $this->shipping_data?->toArray(),
            'free_shipping' => $this->free_shipping?->toArray(),
            'allow_category_change' => $this->allow_category_change,
            'unit_quantity' => $this->unit_quantity,
            'unit_type' => $this->unit_type?->toArray(),
            'sku' => $this->sku,
            'discount' => $this->discount,
            'packaging_dimensions' => $this->packaging_dimensions?->toArray(),
            'is_wholesale' => $this->is_wholesale,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}