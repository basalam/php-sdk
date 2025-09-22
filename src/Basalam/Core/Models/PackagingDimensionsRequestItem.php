<?php

namespace Basalam\Core\Models;

class PackagingDimensionsRequestItem implements \JsonSerializable
{
    public int $height;
    public int $length;
    public int $width;

    public function __construct(array $data)
    {
        $this->height = $data['height'];
        $this->length = $data['length'];
        $this->width = $data['width'];
    }

    public function toArray(): array
    {
        return [
            'height' => $this->height,
            'length' => $this->length,
            'width' => $this->width,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}