<?php

namespace Basalam\Core\Models;

class CreateDiscountRequestSchema implements \JsonSerializable
{
    public ?DiscountProductFilterSchema $product_filter;
    public ?int $discount_percent;
    public ?int $active_days;

    public function __construct(array $data)
    {
        if (isset($data['product_filter'])) {
            $this->product_filter = $data['product_filter'] instanceof DiscountProductFilterSchema
                ? $data['product_filter']
                : new DiscountProductFilterSchema($data['product_filter']);
        } else {
            $this->product_filter = null;
        }
        $this->discount_percent = $data['discount_percent'] ?? null;
        $this->active_days = $data['active_days'] ?? null;
    }

    public function toArray(): array
    {
        $result = [
            'discount_percent' => $this->discount_percent,
            'active_days' => $this->active_days,
        ];
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