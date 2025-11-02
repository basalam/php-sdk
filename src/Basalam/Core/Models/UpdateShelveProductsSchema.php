<?php

namespace Basalam\Core\Models;

class UpdateShelveProductsSchema implements \JsonSerializable
{
    public ?array $include_products;
    public ?array $exclude_products;

    public function __construct(array $data = [])
    {
        $this->include_products = $data['include_products'] ?? [];
        $this->exclude_products = $data['exclude_products'] ?? [];
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->include_products !== null) $result['include_products'] = $this->include_products;
        if ($this->exclude_products !== null) $result['exclude_products'] = $this->exclude_products;

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
