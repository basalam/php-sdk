<?php

namespace Basalam\Core\Models;

class ProductRevisionResponse implements \JsonSerializable
{
    public ?array $rejection_reasons;
    public ?ProductRevisionDataResponse $data;
    public ?string $rejected_at;
    public ?RevisionMetadataResponse $metadata;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->rejection_reasons = isset($data['rejection_reasons'])
            ? array_map(fn($reason) => RejectionReasonResponse::fromArray($reason), $data['rejection_reasons'])
            : null;
        $model->data = isset($data['data'])
            ? ProductRevisionDataResponse::fromArray($data['data'])
            : null;
        $model->rejected_at = $data['rejected_at'] ?? null;
        $model->metadata = isset($data['metadata'])
            ? RevisionMetadataResponse::fromArray($data['metadata'])
            : null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'rejection_reasons' => $this->rejection_reasons ? array_map(fn($reason) => $reason->toArray(), $this->rejection_reasons) : null,
            'data' => $this->data?->toArray(),
            'rejected_at' => $this->rejected_at,
            'metadata' => $this->metadata?->toArray(),
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}