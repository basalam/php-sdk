<?php

namespace Basalam\Core\Models;

class DeleteDiscountRequestSchema implements \JsonSerializable
{
    public ?DiscountProductFilterSchema $product_filter;

    public function __construct(array $data = [])
    {
        if (isset($data['product_filter'])) {
            $this->product_filter = $data['product_filter'] instanceof DiscountProductFilterSchema
                ? $data['product_filter']
                : new DiscountProductFilterSchema($data['product_filter']);
        } else {
            $this->product_filter = null;
        }
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->product_filter !== null) {
            $result['product_filter'] = $this->product_filter->toArray();
        }
        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}