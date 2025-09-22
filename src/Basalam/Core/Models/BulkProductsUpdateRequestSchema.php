<?php

namespace Basalam\Core\Models;

class BulkProductsUpdateRequestSchema implements \JsonSerializable
{
    public ?ProductFilterSchema $product_filter;
    public array $action;

    public function __construct(array $data)
    {
        if (isset($data['product_filter'])) {
            $this->product_filter = $data['product_filter'] instanceof ProductFilterSchema
                ? $data['product_filter']
                : new ProductFilterSchema($data['product_filter']);
        } else {
            $this->product_filter = null;
        }

        // Handle both single item and array
        if (isset($data['action'])) {
            if ($data['action'] instanceof BulkActionItem) {
                $this->action = [$data['action']];
            } elseif (is_array($data['action']) && !isset($data['action'][0])) {
                // Single action as associative array
                $this->action = [new BulkActionItem($data['action'])];
            } else {
                // Array of actions
                $this->action = array_map(
                    fn($action) => $action instanceof BulkActionItem ? $action : new BulkActionItem($action),
                    $data['action']
                );
            }
        } else {
            $this->action = [];
        }
    }

    public function toArray(): array
    {
        $result = [
            'action' => array_map(fn($action) => $action->toArray(), $this->action),
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