<?php

namespace Basalam\Core\Models;

class VendorLegalRequestSchema implements \JsonSerializable
{
    public ?bool $is_legal;

    public function __construct(array $data = [])
    {
        $this->is_legal = $data['is_legal'] ?? null;
    }

    public function toArray(): array
    {
        return array_filter([
            'is_legal' => $this->is_legal,
        ], fn($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}