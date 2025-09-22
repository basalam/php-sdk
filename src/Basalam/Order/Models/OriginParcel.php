<?php

namespace Basalam\Order\Models;

/**
 * Origin parcel model
 */
class OriginParcel implements \JsonSerializable
{
    private ?int $id;
    private ?OriginShippingMethod $shippingMethod;
    private ?int $preparationDays;
    private ?int $deliveryDays;
    private ?int $arrivalDeliveryDays;

    public function __construct(
        ?int                  $id = null,
        ?OriginShippingMethod $shippingMethod = null,
        ?int                  $preparationDays = null,
        ?int                  $deliveryDays = null,
        ?int                  $arrivalDeliveryDays = null
    )
    {
        $this->id = $id;
        $this->shippingMethod = $shippingMethod;
        $this->preparationDays = $preparationDays;
        $this->deliveryDays = $deliveryDays;
        $this->arrivalDeliveryDays = $arrivalDeliveryDays;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            isset($data['shipping_method']) ? OriginShippingMethod::fromArray($data['shipping_method']) : null,
            $data['preparation_days'] ?? null,
            $data['delivery_days'] ?? null,
            $data['arrival_delivery_days'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->id !== null) $result['id'] = $this->id;
        if ($this->shippingMethod !== null) $result['shipping_method'] = $this->shippingMethod->toArray();
        if ($this->preparationDays !== null) $result['preparation_days'] = $this->preparationDays;
        if ($this->deliveryDays !== null) $result['delivery_days'] = $this->deliveryDays;
        if ($this->arrivalDeliveryDays !== null) $result['arrival_delivery_days'] = $this->arrivalDeliveryDays;
        return $result;
    }

    // Getters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShippingMethod(): ?OriginShippingMethod
    {
        return $this->shippingMethod;
    }

    public function getPreparationDays(): ?int
    {
        return $this->preparationDays;
    }

    public function getDeliveryDays(): ?int
    {
        return $this->deliveryDays;
    }

    public function getArrivalDeliveryDays(): ?int
    {
        return $this->arrivalDeliveryDays;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}