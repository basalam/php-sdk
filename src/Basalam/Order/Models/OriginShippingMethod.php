<?php

namespace Basalam\Order\Models;

/**
 * Origin shipping method model
 */
class OriginShippingMethod implements \JsonSerializable
{
    private ?int $id;
    private ?ShippingMethodInfo $method;
    private ?int $deliveryTime;
    private ?array $warehouse;

    public function __construct(
        ?int                $id = null,
        ?ShippingMethodInfo $method = null,
        ?int                $deliveryTime = null,
        ?array              $warehouse = null
    )
    {
        $this->id = $id;
        $this->method = $method;
        $this->deliveryTime = $deliveryTime;
        $this->warehouse = $warehouse;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            isset($data['method']) ? ShippingMethodInfo::fromArray($data['method']) : null,
            $data['delivery_time'] ?? null,
            $data['warehouse'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->id !== null) $result['id'] = $this->id;
        if ($this->method !== null) $result['method'] = $this->method->toArray();
        if ($this->deliveryTime !== null) $result['delivery_time'] = $this->deliveryTime;
        if ($this->warehouse !== null) $result['warehouse'] = $this->warehouse;
        return $result;
    }

    // Getters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMethod(): ?ShippingMethodInfo
    {
        return $this->method;
    }

    public function getDeliveryTime(): ?int
    {
        return $this->deliveryTime;
    }

    public function getWarehouse(): ?array
    {
        return $this->warehouse;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}