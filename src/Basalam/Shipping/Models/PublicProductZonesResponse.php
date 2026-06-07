<?php

namespace Basalam\Shipping\Models;

/**
 * PublicProductZonesResponse model.
 */
class PublicProductZonesResponse implements \JsonSerializable
{
    private int $productId;
    private int $vendorId;
    private array $shippingZones;
    private array $freeShippingZones;

    public function __construct(
        int $productId,
        int $vendorId,
        array $shippingZones,
        array $freeShippingZones
    ) {
        $this->productId = $productId;
        $this->vendorId = $vendorId;
        $this->shippingZones = $shippingZones;
        $this->freeShippingZones = $freeShippingZones;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['product_id'],
            $data['vendor_id'],
            array_map(fn($item) => ShippingZone::fromArray($item), $data['shipping_zones'] ?? []),
            array_map(fn($item) => ShippingZoneWithThreshold::fromArray($item), $data['free_shipping_zones'] ?? [])
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['product_id'] = $this->productId;
        $result['vendor_id'] = $this->vendorId;
        $result['shipping_zones'] = array_map(fn($item) => $item->toArray(), $this->shippingZones);
        $result['free_shipping_zones'] = array_map(fn($item) => $item->toArray(), $this->freeShippingZones);
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getVendorId(): int
    {
        return $this->vendorId;
    }

    public function getShippingZones(): array
    {
        return $this->shippingZones;
    }

    public function getFreeShippingZones(): array
    {
        return $this->freeShippingZones;
    }
}
