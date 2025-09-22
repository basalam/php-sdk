<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Recipient model.
 */
class Recipient implements JsonSerializable
{
    private string $name;
    private ?string $mobile;
    private ?string $postalCode;
    private ?string $postalAddress;
    private ?float $latitude;
    private ?float $longitude;
    private ?string $houseNumber;
    private ?string $houseUnit;

    public function __construct(
        string  $name,
        ?string $mobile = null,
        ?string $postalCode = null,
        ?string $postalAddress = null,
        ?float  $latitude = null,
        ?float  $longitude = null,
        ?string $houseNumber = null,
        ?string $houseUnit = null
    )
    {
        $this->name = $name;
        $this->mobile = $mobile;
        $this->postalCode = $postalCode;
        $this->postalAddress = $postalAddress;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->houseNumber = $houseNumber;
        $this->houseUnit = $houseUnit;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['mobile'] ?? null,
            $data['postal_code'] ?? null,
            $data['postal_address'] ?? null,
            $data['latitude'] ?? null,
            $data['longitude'] ?? null,
            $data['house_number'] ?? null,
            $data['house_unit'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'mobile' => $this->mobile,
            'postal_code' => $this->postalCode,
            'postal_address' => $this->postalAddress,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'house_number' => $this->houseNumber,
            'house_unit' => $this->houseUnit,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}