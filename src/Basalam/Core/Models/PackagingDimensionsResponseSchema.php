<?php

namespace Basalam\Core\Models;

class PackagingDimensionsResponseSchema implements \JsonSerializable
{
    public ?int $height;
    public ?int $width;
    public ?int $length;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->height = $data['height'] ?? null;
        $model->width = $data['width'] ?? null;
        $model->length = $data['length'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'height' => $this->height,
            'width' => $this->width,
            'length' => $this->length,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}