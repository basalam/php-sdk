<?php

namespace Basalam\Core\Models;

class ShippingDataRequestItem implements \JsonSerializable
{
    public bool $illegal_for_iran;
    public bool $illegal_for_same_city;

    public function __construct(array $data)
    {
        $this->illegal_for_iran = $data['illegal_for_iran'];
        $this->illegal_for_same_city = $data['illegal_for_same_city'];
    }

    public function toArray(): array
    {
        return [
            'illegal_for_iran' => $this->illegal_for_iran,
            'illegal_for_same_city' => $this->illegal_for_same_city,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}