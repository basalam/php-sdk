<?php

namespace Basalam\Core\Models;

class BatchUpdateProductsRequest implements \JsonSerializable
{
    public ?array $data;

    public function __construct(array $data = [])
    {
        // Handle both 'data' and 'products' keys for compatibility
        $items = $data['data'] ?? $data['products'] ?? null;
        if ($items !== null) {
            $this->data = array_map(
                fn($item) => $item instanceof UpdateProductRequestItem ? $item : new UpdateProductRequestItem($item),
                $items
            );
        } else {
            $this->data = null;
        }
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->data !== null) {
            $result['data'] = array_map(
                fn($item) => $item->toArray(),
                $this->data
            );
        }
        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}