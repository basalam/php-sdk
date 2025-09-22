<?php

namespace Basalam\Order\Models;

/**
 * Origin model
 */
class Origin implements \JsonSerializable
{
    private ?int $id;
    private ?string $title;
    private ?string $type;
    private ?OriginParcel $parcel;
    private ?City $city;
    private ?bool $isWarehouse;
    private ?array $vendorIdentifiers;
    private ?CostBreakdown $deliveryCosts;

    public function __construct(
        ?int           $id = null,
        ?string        $title = null,
        ?string        $type = null,
        ?OriginParcel  $parcel = null,
        ?City          $city = null,
        ?bool          $isWarehouse = null,
        ?array         $vendorIdentifiers = null,
        ?CostBreakdown $deliveryCosts = null
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->type = $type;
        $this->parcel = $parcel;
        $this->city = $city;
        $this->isWarehouse = $isWarehouse;
        $this->vendorIdentifiers = $vendorIdentifiers;
        $this->deliveryCosts = $deliveryCosts;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['title'] ?? null,
            $data['type'] ?? null,
            isset($data['parcel']) ? OriginParcel::fromArray($data['parcel']) : null,
            isset($data['city']) ? City::fromArray($data['city']) : null,
            $data['is_warehouse'] ?? null,
            $data['vendor_identifiers'] ?? null,
            isset($data['delivery_costs']) ? CostBreakdown::fromArray($data['delivery_costs']) : null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->id !== null) $result['id'] = $this->id;
        if ($this->title !== null) $result['title'] = $this->title;
        if ($this->type !== null) $result['type'] = $this->type;
        if ($this->parcel !== null) $result['parcel'] = $this->parcel->toArray();
        if ($this->city !== null) $result['city'] = $this->city->toArray();
        if ($this->isWarehouse !== null) $result['is_warehouse'] = $this->isWarehouse;
        if ($this->vendorIdentifiers !== null) $result['vendor_identifiers'] = $this->vendorIdentifiers;
        if ($this->deliveryCosts !== null) $result['delivery_costs'] = $this->deliveryCosts->toArray();
        return $result;
    }

    // Getters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getParcel(): ?OriginParcel
    {
        return $this->parcel;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function isWarehouse(): ?bool
    {
        return $this->isWarehouse;
    }

    public function getVendorIdentifiers(): ?array
    {
        return $this->vendorIdentifiers;
    }

    public function getDeliveryCosts(): ?CostBreakdown
    {
        return $this->deliveryCosts;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}