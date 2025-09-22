<?php

namespace Basalam\Core\Models;

class ProductRequestSchema implements \JsonSerializable
{
    public string $name;
    public ?int $photo;
    public ?array $photos;
    public ?int $video;
    public ?string $brief;
    public ?string $description;
    public ?int $order;
    public ?int $category_id;
    public int $status = ProductStatusInputEnum::PUBLISHED;
    public int $preparation_days = 1;
    public ?array $keywords = null;
    public ?float $weight = null;
    public ?int $package_weight = null;
    public ?int $primary_price = null;
    public ?int $stock = null;
    public ?array $shipping_city_ids = null;
    public ?array $shipping_method_ids = null;
    public ?array $product_attribute = null;
    public ?bool $virtual = null;
    public ?array $variants = null;
    public ?ShippingDataRequestItem $shipping_data;
    public ?float $unit_quantity;
    public ?int $unit_type;
    public ?string $sku;
    public ?PackagingDimensionsRequestItem $packaging_dimensions;
    public bool $is_wholesale = false;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->category_id = $data['category_id'] ?? null;
        $this->status = $data['status'] ?? null;
        $this->package_weight = $data['package_weight'] ?? null;
        $this->primary_price = $data['primary_price'] ?? null;

        $this->photo = $data['photo'] ?? null;
        $this->photos = $data['photos'] ?? null;
        $this->video = $data['video'] ?? null;
        $this->brief = $data['brief'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->order = $data['order'] ?? null;
        $this->preparation_days = $data['preparation_days'] ?? 1;
        $this->keywords = $data['keywords'] ?? null;
        $this->weight = $data['weight'] ?? null;
        $this->stock = $data['stock'] ?? null;
        $this->shipping_city_ids = $data['shipping_city_ids'] ?? null;
        $this->shipping_method_ids = $data['shipping_method_ids'] ?? null;

        if (isset($data['product_attribute'])) {
            $this->product_attribute = array_map(
                fn($attr) => new ProductAttributeRequestItem($attr),
                $data['product_attribute']
            );
        }

        $this->virtual = $data['virtual'] ?? null;

        if (isset($data['variants'])) {
            $this->variants = array_map(
                fn($variant) => new VariantRequestItem($variant),
                $data['variants']
            );
        }

        $this->shipping_data = isset($data['shipping_data'])
            ? new ShippingDataRequestItem($data['shipping_data'])
            : null;

        $this->unit_quantity = $data['unit_quantity'] ?? null;
        $this->unit_type = $data['unit_type'] ?? null;
        $this->sku = $data['sku'] ?? null;

        $this->packaging_dimensions = isset($data['packaging_dimensions'])
            ? new PackagingDimensionsRequestItem($data['packaging_dimensions'])
            : null;

        $this->is_wholesale = $data['is_wholesale'] ?? false;
    }

    public function toArray(): array
    {
        $result = [
            'name' => $this->name,
            'preparation_days' => $this->preparation_days,
            'is_wholesale' => $this->is_wholesale,
        ];

        if ($this->category_id !== null) $result['category_id'] = $this->category_id;
        if ($this->status !== null) $result['status'] = $this->status;

        if ($this->package_weight !== null) $result['package_weight'] = $this->package_weight;
        if ($this->primary_price !== null) $result['primary_price'] = $this->primary_price;

        if ($this->photo !== null) $result['photo'] = $this->photo;
        if ($this->photos !== null) $result['photos'] = $this->photos;
        if ($this->video !== null) $result['video'] = $this->video;
        if ($this->brief !== null) $result['brief'] = $this->brief;
        if ($this->description !== null) $result['description'] = $this->description;
        if ($this->order !== null) $result['order'] = $this->order;
        if ($this->keywords !== null) $result['keywords'] = $this->keywords;
        if ($this->weight !== null) $result['weight'] = $this->weight;
        if ($this->stock !== null) $result['stock'] = $this->stock;
        if ($this->shipping_city_ids !== null) $result['shipping_city_ids'] = $this->shipping_city_ids;
        if ($this->shipping_method_ids !== null) $result['shipping_method_ids'] = $this->shipping_method_ids;

        if ($this->product_attribute !== null) {
            $result['product_attribute'] = array_map(
                fn($attr) => $attr->toArray(),
                $this->product_attribute
            );
        }

        if ($this->virtual !== null) $result['virtual'] = $this->virtual;

        if ($this->variants !== null) {
            $result['variants'] = array_map(
                fn($variant) => $variant->toArray(),
                $this->variants
            );
        }

        if ($this->shipping_data !== null) {
            $result['shipping_data'] = $this->shipping_data->toArray();
        }

        if ($this->unit_quantity !== null) $result['unit_quantity'] = $this->unit_quantity;
        if ($this->unit_type !== null) $result['unit_type'] = $this->unit_type;
        if ($this->sku !== null) $result['sku'] = $this->sku;

        if ($this->packaging_dimensions !== null) {
            $result['packaging_dimensions'] = $this->packaging_dimensions->toArray();
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}