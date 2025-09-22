<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Parcel response model.
 */
class ParcelResponse implements JsonSerializable
{
    private int $id;
    private int $totalItemsPrice;
    private ?string $estimateSendAt;
    private string $createdAt;
    private string $updatedAt;
    private string $confirmedAt;
    private ?string $sendAt;
    private string $deliveryAt;
    private bool $isConfirmed;
    private bool $isSendDate;
    private bool $isDelivered;
    private ?bool $hasDelay;
    private int $delayDays;
    private int $shippingCost;
    private ShippingMethod $shippingMethod;
    private ?Status $status;
    private Vendor $vendor;
    private array $items;
    private ParcelOrder $order;
    private ?PostReceipt $postReceipt;

    public function __construct(
        int            $id,
        int            $totalItemsPrice,
        string         $createdAt,
        string         $updatedAt,
        string         $confirmedAt,
        string         $deliveryAt,
        bool           $isConfirmed,
        bool           $isSendDate,
        bool           $isDelivered,
        int            $delayDays,
        int            $shippingCost,
        ShippingMethod $shippingMethod,
        Vendor         $vendor,
        array          $items,
        ParcelOrder    $order,
        ?string        $estimateSendAt = null,
        ?string        $sendAt = null,
        ?bool          $hasDelay = null,
        ?Status        $status = null,
        ?PostReceipt   $postReceipt = null
    )
    {
        $this->id = $id;
        $this->totalItemsPrice = $totalItemsPrice;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->confirmedAt = $confirmedAt;
        $this->deliveryAt = $deliveryAt;
        $this->isConfirmed = $isConfirmed;
        $this->isSendDate = $isSendDate;
        $this->isDelivered = $isDelivered;
        $this->delayDays = $delayDays;
        $this->shippingCost = $shippingCost;
        $this->shippingMethod = $shippingMethod;
        $this->vendor = $vendor;
        $this->items = $items;
        $this->order = $order;
        $this->estimateSendAt = $estimateSendAt;
        $this->sendAt = $sendAt;
        $this->hasDelay = $hasDelay;
        $this->status = $status;
        $this->postReceipt = $postReceipt;
    }

    public static function fromArray(array $data): self
    {
        $items = array_map(fn($item) => ParcelItemResponse::fromArray($item), $data['items']);

        return new self(
            $data['id'],
            $data['total_items_price'],
            $data['created_at'],
            $data['updated_at'],
            $data['confirmed_at'],
            $data['delivery_at'],
            $data['is_confirmed'],
            $data['is_send_date'],
            $data['is_delivered'],
            $data['delay_days'],
            $data['shipping_cost'],
            ShippingMethod::fromArray($data['shipping_method']),
            Vendor::fromArray($data['vendor']),
            $items,
            ParcelOrder::fromArray($data['order']),
            $data['estimate_send_at'] ?? null,
            $data['send_at'] ?? null,
            $data['has_delay'] ?? null,
            isset($data['status']) ? Status::fromArray($data['status']) : null,
            isset($data['post_receipt']) ? PostReceipt::fromArray($data['post_receipt']) : null
        );
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getTotalItemsPrice(): int
    {
        return $this->totalItemsPrice;
    }

    public function getEstimateSendAt(): ?string
    {
        return $this->estimateSendAt;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getConfirmedAt(): string
    {
        return $this->confirmedAt;
    }

    public function getSendAt(): ?string
    {
        return $this->sendAt;
    }

    public function getDeliveryAt(): string
    {
        return $this->deliveryAt;
    }

    public function getIsConfirmed(): bool
    {
        return $this->isConfirmed;
    }

    public function getIsSendDate(): bool
    {
        return $this->isSendDate;
    }

    public function getIsDelivered(): bool
    {
        return $this->isDelivered;
    }

    public function getHasDelay(): ?bool
    {
        return $this->hasDelay;
    }

    public function getDelayDays(): int
    {
        return $this->delayDays;
    }

    public function getShippingCost(): int
    {
        return $this->shippingCost;
    }

    public function getShippingMethod(): ShippingMethod
    {
        return $this->shippingMethod;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function getVendor(): Vendor
    {
        return $this->vendor;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getOrder(): ParcelOrder
    {
        return $this->order;
    }

    public function getPostReceipt(): ?PostReceipt
    {
        return $this->postReceipt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'total_items_price' => $this->totalItemsPrice,
            'estimate_send_at' => $this->estimateSendAt,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'confirmed_at' => $this->confirmedAt,
            'send_at' => $this->sendAt,
            'delivery_at' => $this->deliveryAt,
            'is_confirmed' => $this->isConfirmed,
            'is_send_date' => $this->isSendDate,
            'is_delivered' => $this->isDelivered,
            'has_delay' => $this->hasDelay,
            'delay_days' => $this->delayDays,
            'shipping_cost' => $this->shippingCost,
            'shipping_method' => $this->shippingMethod->toArray(),
            'status' => $this->status?->toArray(),
            'vendor' => $this->vendor->toArray(),
            'items' => array_map(fn($item) => $item->toArray(), $this->items),
            'order' => $this->order->toArray(),
            'post_receipt' => $this->postReceipt?->toArray(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}