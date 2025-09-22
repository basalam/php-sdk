<?php

namespace Basalam\Order\Models;

/**
 * Basket vendor model
 */
class BasketVendor implements \JsonSerializable
{
    private ?int $id;
    private ?string $identifier;
    private ?string $urlAlias;
    private ?string $title;
    private ?array $logo;
    private ?VendorOwner $owner;
    private ?int $totalProductAmount;
    private ?int $freeShippingAmount;
    private ?string $freeShippingType;
    private ?array $items;
    private ?City $city;
    private ?array $parcelIdentifiers;
    private ?array $originIdentifiers;
    private ?int $preparationDays;
    private ?int $deliveryDays;
    private ?int $arrivalDays;
    private ?CostBreakdown $deliveryCosts;

    public function __construct(
        ?int           $id = null,
        ?string        $identifier = null,
        ?string        $urlAlias = null,
        ?string        $title = null,
        ?array         $logo = null,
        ?VendorOwner   $owner = null,
        ?int           $totalProductAmount = null,
        ?int           $freeShippingAmount = null,
        ?string        $freeShippingType = null,
        ?array         $items = null,
        ?City          $city = null,
        ?array         $parcelIdentifiers = null,
        ?array         $originIdentifiers = null,
        ?int           $preparationDays = null,
        ?int           $deliveryDays = null,
        ?int           $arrivalDays = null,
        ?CostBreakdown $deliveryCosts = null
    )
    {
        $this->id = $id;
        $this->identifier = $identifier;
        $this->urlAlias = $urlAlias;
        $this->title = $title;
        $this->logo = $logo;
        $this->owner = $owner;
        $this->totalProductAmount = $totalProductAmount;
        $this->freeShippingAmount = $freeShippingAmount;
        $this->freeShippingType = $freeShippingType;
        $this->items = $items;
        $this->city = $city;
        $this->parcelIdentifiers = $parcelIdentifiers;
        $this->originIdentifiers = $originIdentifiers;
        $this->preparationDays = $preparationDays;
        $this->deliveryDays = $deliveryDays;
        $this->arrivalDays = $arrivalDays;
        $this->deliveryCosts = $deliveryCosts;
    }

    public static function fromArray(array $data): self
    {
        $items = null;
        if (isset($data['items'])) {
            $items = array_map(
                fn($item) => is_array($item) ? BasketVendorItem::fromArray($item) : $item,
                $data['items']
            );
        }

        return new self(
            $data['id'] ?? null,
            $data['identifier'] ?? null,
            $data['url_alias'] ?? null,
            $data['title'] ?? null,
            $data['logo'] ?? null,
            isset($data['owner']) ? VendorOwner::fromArray($data['owner']) : null,
            $data['total_product_amount'] ?? null,
            $data['free_shipping_amount'] ?? null,
            $data['free_shipping_type'] ?? null,
            $items,
            isset($data['city']) ? City::fromArray($data['city']) : null,
            $data['parcel_identifiers'] ?? null,
            $data['origin_identifiers'] ?? null,
            $data['preparation_days'] ?? null,
            $data['delivery_days'] ?? null,
            $data['arrival_days'] ?? null,
            isset($data['delivery_costs']) ? CostBreakdown::fromArray($data['delivery_costs']) : null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->id !== null) $result['id'] = $this->id;
        if ($this->identifier !== null) $result['identifier'] = $this->identifier;
        if ($this->urlAlias !== null) $result['url_alias'] = $this->urlAlias;
        if ($this->title !== null) $result['title'] = $this->title;
        if ($this->logo !== null) $result['logo'] = $this->logo;
        if ($this->owner !== null) $result['owner'] = $this->owner->toArray();
        if ($this->totalProductAmount !== null) $result['total_product_amount'] = $this->totalProductAmount;
        if ($this->freeShippingAmount !== null) $result['free_shipping_amount'] = $this->freeShippingAmount;
        if ($this->freeShippingType !== null) $result['free_shipping_type'] = $this->freeShippingType;
        if ($this->items !== null) {
            $result['items'] = array_map(
                fn($item) => $item instanceof BasketVendorItem ? $item->toArray() : $item,
                $this->items
            );
        }
        if ($this->city !== null) $result['city'] = $this->city->toArray();
        if ($this->parcelIdentifiers !== null) $result['parcel_identifiers'] = $this->parcelIdentifiers;
        if ($this->originIdentifiers !== null) $result['origin_identifiers'] = $this->originIdentifiers;
        if ($this->preparationDays !== null) $result['preparation_days'] = $this->preparationDays;
        if ($this->deliveryDays !== null) $result['delivery_days'] = $this->deliveryDays;
        if ($this->arrivalDays !== null) $result['arrival_days'] = $this->arrivalDays;
        if ($this->deliveryCosts !== null) $result['delivery_costs'] = $this->deliveryCosts->toArray();
        return $result;
    }

    // Getters (abbreviated)

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getOwner(): ?VendorOwner
    {
        return $this->owner;
    }

    public function getItems(): ?array
    {
        return $this->items;
    }

    public function getCity(): ?City
    {
        return $this->city;
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