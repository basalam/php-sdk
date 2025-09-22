<?php

namespace Basalam\Core\Models;

class UpdateShippingMethodSchema implements \JsonSerializable
{
    public ?array $shipping_methods;

    public function __construct(array $data = [])
    {
        if (isset($data['shipping_methods'])) {
            $this->shipping_methods = array_map(
                fn($item) => $item instanceof ShippingMethodUpdateItem ? $item : new ShippingMethodUpdateItem($item),
                $data['shipping_methods']
            );
        } else {
            $this->shipping_methods = null;
        }
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->shipping_methods !== null) {
            $result['shipping_methods'] = array_map(
                fn($item) => $item->toArray(),
                $this->shipping_methods
            );
        }
        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}