<?php

namespace Basalam\Order\Models;

/**
 * Basket address model
 */
class BasketAddress implements \JsonSerializable
{
    private ?int $id;
    private ?string $name;
    private ?string $mobile;
    private ?string $tel;
    private ?string $address;
    private ?string $postalCode;
    private ?bool $isDefault;
    private ?City $city;
    private ?float $latitude;
    private ?float $longitude;
    private ?string $houseNumber;
    private ?string $houseUnit;

    public function __construct(
        ?int    $id = null,
        ?string $name = null,
        ?string $mobile = null,
        ?string $tel = null,
        ?string $address = null,
        ?string $postalCode = null,
        ?bool   $isDefault = null,
        ?City   $city = null,
        ?float  $latitude = null,
        ?float  $longitude = null,
        ?string $houseNumber = null,
        ?string $houseUnit = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->mobile = $mobile;
        $this->tel = $tel;
        $this->address = $address;
        $this->postalCode = $postalCode;
        $this->isDefault = $isDefault;
        $this->city = $city;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->houseNumber = $houseNumber;
        $this->houseUnit = $houseUnit;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['name'] ?? null,
            $data['mobile'] ?? null,
            $data['tel'] ?? null,
            $data['address'] ?? null,
            $data['postal_code'] ?? null,
            $data['is_default'] ?? null,
            isset($data['city']) ? City::fromArray($data['city']) : null,
            $data['latitude'] ?? null,
            $data['longitude'] ?? null,
            $data['house_number'] ?? null,
            $data['house_unit'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->id !== null) $result['id'] = $this->id;
        if ($this->name !== null) $result['name'] = $this->name;
        if ($this->mobile !== null) $result['mobile'] = $this->mobile;
        if ($this->tel !== null) $result['tel'] = $this->tel;
        if ($this->address !== null) $result['address'] = $this->address;
        if ($this->postalCode !== null) $result['postal_code'] = $this->postalCode;
        if ($this->isDefault !== null) $result['is_default'] = $this->isDefault;
        if ($this->city !== null) $result['city'] = $this->city->toArray();
        if ($this->latitude !== null) $result['latitude'] = $this->latitude;
        if ($this->longitude !== null) $result['longitude'] = $this->longitude;
        if ($this->houseNumber !== null) $result['house_number'] = $this->houseNumber;
        if ($this->houseUnit !== null) $result['house_unit'] = $this->houseUnit;

        return $result;
    }

    // Getters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function isDefault(): ?bool
    {
        return $this->isDefault;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    public function getHouseUnit(): ?string
    {
        return $this->houseUnit;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}