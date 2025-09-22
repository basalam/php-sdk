<?php

namespace Basalam\Core\Models;

class RevisionMetadataResponse implements \JsonSerializable
{
    public ?array $illegal_photos;
    public ?string $description;
    public ?bool $is_conditional_approval;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->illegal_photos = isset($data['illegal_photos'])
            ? array_map(fn($photo) => IllegalPhotoResponse::fromArray($photo), $data['illegal_photos'])
            : null;
        $model->description = $data['description'] ?? null;
        $model->is_conditional_approval = $data['is_conditional_approval'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'illegal_photos' => $this->illegal_photos ? array_map(fn($photo) => $photo->toArray(), $this->illegal_photos) : null,
            'description' => $this->description,
            'is_conditional_approval' => $this->is_conditional_approval,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}