<?php

namespace Basalam\Core\Models;

class UpdateVendorStatusResponse implements \JsonSerializable
{
    public ?int $status;
    public ?string $updated_at;
    public ?int $reason;
    public ?bool $is_status_changed;
    public ?string $activated_at;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->status = $data['status'] ?? null;
        $model->updated_at = $data['updated_at'] ?? null;
        $model->reason = $data['reason'] ?? null;
        $model->is_status_changed = $data['is_status_changed'] ?? null;
        $model->activated_at = $data['activated_at'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'updated_at' => $this->updated_at,
            'reason' => $this->reason,
            'is_status_changed' => $this->is_status_changed,
            'activated_at' => $this->activated_at,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}