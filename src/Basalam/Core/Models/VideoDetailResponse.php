<?php

namespace Basalam\Core\Models;

class VideoDetailResponse implements \JsonSerializable
{
    public ?int $id;
    public ?string $url;
    public ?string $original;
    public ?string $thumbnail;
    public ?string $hls;
    public ?int $width;
    public ?int $height;
    public ?int $duration;

    public static function fromArray(array $data): self
    {
        $model = new self();
        $model->id = $data['id'] ?? null;
        $model->url = $data['url'] ?? null;
        $model->original = $data['original'] ?? null;
        $model->thumbnail = $data['thumbnail'] ?? null;
        $model->hls = $data['hls'] ?? null;
        $model->width = $data['width'] ?? null;
        $model->height = $data['height'] ?? null;
        $model->duration = $data['duration'] ?? null;
        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'original' => $this->original,
            'thumbnail' => $this->thumbnail,
            'hls' => $this->hls,
            'width' => $this->width,
            'height' => $this->height,
            'duration' => $this->duration,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}