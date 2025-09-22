<?php

namespace Basalam\Order\Models;

/**
 * Basket vendor item model
 */
class BasketVendorItem implements \JsonSerializable
{
    private ?int $id;
    private ?int $parcelId;
    private ?string $title;
    private ?int $quantity;
    private ?int $price;
    private ?int $primaryPrice;
    private ?int $payableAmount;
    private ?int $deliveryCost;
    private ?int $totalDiscount;
    private ?int $basalamProductDiscount;
    private ?int $basalamDeliveryDiscount;
    private ?int $vendorProductDiscount;
    private ?int $vendorDeliveryDiscount;
    private ?int $publicDeliveryDiscount;
    private ?BasketProduct $product;
    private ?BasketVariation $variation;
    private ?array $vendorCoupon;
    private ?array $errors;
    private ?string $comment;
    private ?bool $isDeleted;

    public function __construct(
        ?int             $id = null,
        ?int             $parcelId = null,
        ?string          $title = null,
        ?int             $quantity = null,
        ?int             $price = null,
        ?int             $primaryPrice = null,
        ?int             $payableAmount = null,
        ?int             $deliveryCost = null,
        ?int             $totalDiscount = null,
        ?int             $basalamProductDiscount = null,
        ?int             $basalamDeliveryDiscount = null,
        ?int             $vendorProductDiscount = null,
        ?int             $vendorDeliveryDiscount = null,
        ?int             $publicDeliveryDiscount = null,
        ?BasketProduct   $product = null,
        ?BasketVariation $variation = null,
        ?array           $vendorCoupon = null,
        ?array           $errors = null,
        ?string          $comment = null,
        ?bool            $isDeleted = null
    )
    {
        $this->id = $id;
        $this->parcelId = $parcelId;
        $this->title = $title;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->primaryPrice = $primaryPrice;
        $this->payableAmount = $payableAmount;
        $this->deliveryCost = $deliveryCost;
        $this->totalDiscount = $totalDiscount;
        $this->basalamProductDiscount = $basalamProductDiscount;
        $this->basalamDeliveryDiscount = $basalamDeliveryDiscount;
        $this->vendorProductDiscount = $vendorProductDiscount;
        $this->vendorDeliveryDiscount = $vendorDeliveryDiscount;
        $this->publicDeliveryDiscount = $publicDeliveryDiscount;
        $this->product = $product;
        $this->variation = $variation;
        $this->vendorCoupon = $vendorCoupon;
        $this->errors = $errors;
        $this->comment = $comment;
        $this->isDeleted = $isDeleted;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['parcel_id'] ?? null,
            $data['title'] ?? null,
            $data['quantity'] ?? null,
            $data['price'] ?? null,
            $data['primary_price'] ?? null,
            $data['payable_amount'] ?? null,
            $data['delivery_cost'] ?? null,
            $data['total_discount'] ?? null,
            $data['basalam_product_discount'] ?? null,
            $data['basalam_delivery_discount'] ?? null,
            $data['vendor_product_discount'] ?? null,
            $data['vendor_delivery_discount'] ?? null,
            $data['public_delivery_discount'] ?? null,
            isset($data['product']) ? BasketProduct::fromArray($data['product']) : null,
            isset($data['variation']) ? BasketVariation::fromArray($data['variation']) : null,
            $data['vendor_coupon'] ?? null,
            $data['errors'] ?? null,
            $data['comment'] ?? null,
            $data['is_deleted'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->id !== null) $result['id'] = $this->id;
        if ($this->parcelId !== null) $result['parcel_id'] = $this->parcelId;
        if ($this->title !== null) $result['title'] = $this->title;
        if ($this->quantity !== null) $result['quantity'] = $this->quantity;
        if ($this->price !== null) $result['price'] = $this->price;
        if ($this->primaryPrice !== null) $result['primary_price'] = $this->primaryPrice;
        if ($this->payableAmount !== null) $result['payable_amount'] = $this->payableAmount;
        if ($this->deliveryCost !== null) $result['delivery_cost'] = $this->deliveryCost;
        if ($this->totalDiscount !== null) $result['total_discount'] = $this->totalDiscount;
        if ($this->basalamProductDiscount !== null) $result['basalam_product_discount'] = $this->basalamProductDiscount;
        if ($this->basalamDeliveryDiscount !== null) $result['basalam_delivery_discount'] = $this->basalamDeliveryDiscount;
        if ($this->vendorProductDiscount !== null) $result['vendor_product_discount'] = $this->vendorProductDiscount;
        if ($this->vendorDeliveryDiscount !== null) $result['vendor_delivery_discount'] = $this->vendorDeliveryDiscount;
        if ($this->publicDeliveryDiscount !== null) $result['public_delivery_discount'] = $this->publicDeliveryDiscount;
        if ($this->product !== null) $result['product'] = $this->product->toArray();
        if ($this->variation !== null) $result['variation'] = $this->variation->toArray();
        if ($this->vendorCoupon !== null) $result['vendor_coupon'] = $this->vendorCoupon;
        if ($this->errors !== null) $result['errors'] = $this->errors;
        if ($this->comment !== null) $result['comment'] = $this->comment;
        if ($this->isDeleted !== null) $result['is_deleted'] = $this->isDeleted;
        return $result;
    }

    // Getters (abbreviated for space)

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParcelId(): ?int
    {
        return $this->parcelId;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function getProduct(): ?BasketProduct
    {
        return $this->product;
    }

    public function getVariation(): ?BasketVariation
    {
        return $this->variation;
    }

    public function getErrors(): ?array
    {
        return $this->errors;
    }

    public function isDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}