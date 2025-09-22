<?php

namespace Basalam\Core\Models;

class UpdateProductResponseItem implements \JsonSerializable
{
    public ?int $id;
    public ?bool $is_product_for_revision;
    public ?bool $has_error;
    public ?string $error_message;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->is_product_for_revision = $data['is_product_for_revision'] ?? null;
        $model->has_error = $data['has_error'] ?? null;
        $model->error_message = $data['error_message'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'is_product_for_revision' => $this->is_product_for_revision,
            'has_error' => $this->has_error,
            'error_message' => $this->error_message,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}