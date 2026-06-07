<?php

namespace Basalam\Shipping\Models;

/**
 * ShippingZone model.
 */
class ShippingZone implements \JsonSerializable
{
    private int $id;
    private string $title;

    public function __construct(
        int $id,
        string $title
    ) {
        $this->id = $id;
        $this->title = $title;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['title']
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['id'] = $this->id;
        $result['title'] = $this->title;
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
