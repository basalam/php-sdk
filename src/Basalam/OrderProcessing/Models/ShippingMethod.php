<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Shipping method model.
 */
class ShippingMethod implements JsonSerializable
{
    private ShippingMethodOption $current;
    private ShippingMethodOption $default;

    public function __construct(ShippingMethodOption $current, ShippingMethodOption $default)
    {
        $this->current = $current;
        $this->default = $default;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            ShippingMethodOption::fromArray($data['current']),
            ShippingMethodOption::fromArray($data['default'])
        );
    }

    public function toArray(): array
    {
        return [
            'current' => $this->current->toArray(),
            'default' => $this->default->toArray(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}