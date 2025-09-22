<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Response model for parcel hints of a customer order.
 */
class ParcelHintsResponse implements JsonSerializable
{
    private int $id;
    private array $parcels;

    public function __construct(int $id, array $parcels)
    {
        $this->id = $id;
        $this->parcels = $parcels;
    }

    public static function fromArray(array $data): self
    {
        $parcels = array_map(fn($parcel) => ParcelHint::fromArray($parcel), $data['parcels']);

        return new self(
            $data['id'],
            $parcels
        );
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getParcels(): array
    {
        return $this->parcels;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'parcels' => array_map(fn($parcel) => $parcel->toArray(), $this->parcels),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}