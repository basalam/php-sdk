<?php

namespace Basalam\Chat\Models;

class LocationResource implements \JsonSerializable
{
    private int $geoWidth;
    private int $geoHeight;

    public function __construct(int $geoWidth, int $geoHeight)
    {
        $this->geoWidth = $geoWidth;
        $this->geoHeight = $geoHeight;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['geo_width'],
            $data['geo_height']
        );
    }

    public function toArray(): array
    {
        return [
            'geo_width' => $this->geoWidth,
            'geo_height' => $this->geoHeight,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function getGeoWidth(): int
    {
        return $this->geoWidth;
    }

    public function getGeoHeight(): int
    {
        return $this->geoHeight;
    }
}