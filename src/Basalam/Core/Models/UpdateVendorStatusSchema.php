<?php

namespace Basalam\Core\Models;

class UpdateVendorStatusSchema implements \JsonSerializable
{
    public ?int $status;
    public ?string $description;
    public ?int $reason;

    public function __construct(array $data = [])
    {
        $this->status = $data['status'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->reason = $data['reason'] ?? null;
    }

    public function toArray(): array
    {
        return array_filter([
            'status' => $this->status,
            'description' => $this->description,
            'reason' => $this->reason,
        ], fn($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}