<?php

namespace Basalam\Shipping\Models;

/**
 * CreateProfileZoneRequest model.
 */
class CreateProfileZoneRequest implements \JsonSerializable
{
    private array $locationIds;

    public function __construct(
        array $locationIds
    ) {
        $this->locationIds = $locationIds;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['location_ids']
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['location_ids'] = $this->locationIds;
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getLocationIds(): array
    {
        return $this->locationIds;
    }
}
