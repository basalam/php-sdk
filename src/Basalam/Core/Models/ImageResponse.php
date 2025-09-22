<?php

namespace Basalam\Core\Models;

class ImageResponse implements \JsonSerializable
{
    public ?int $id;
    public ?string $original;
    public ?string $xs;
    public ?string $sm;
    public ?string $md;
    public ?string $lg;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->original = $data['original'] ?? null;
        $model->xs = $data['xs'] ?? null;
        $model->sm = $data['sm'] ?? null;
        $model->md = $data['md'] ?? null;
        $model->lg = $data['lg'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'original' => $this->original,
            'xs' => $this->xs,
            'sm' => $this->sm,
            'md' => $this->md,
            'lg' => $this->lg,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}