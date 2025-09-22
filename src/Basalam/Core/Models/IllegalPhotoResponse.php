<?php

namespace Basalam\Core\Models;

class IllegalPhotoResponse implements \JsonSerializable
{
    public ?int $file_id;
    public ?array $rejection_reasons;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->file_id = $data['file_id'] ?? null;
        $model->rejection_reasons = isset($data['rejection_reasons'])
            ? array_map(fn($reason) => RejectionReasonResponse::fromArray($reason), $data['rejection_reasons'])
            : null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'file_id' => $this->file_id,
            'rejection_reasons' => $this->rejection_reasons !== null
                ? array_map(fn($reason) => $reason->toArray(), $this->rejection_reasons)
                : null,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}