<?php

namespace Basalam\Chat\Models;

class AttachmentFile implements \JsonSerializable
{
    private int $id;
    private string $url;
    private ?int $height;
    private ?int $width;
    private ?string $name;
    private ?string $type;
    private ?int $size;
    private ?string $blurHash;

    public function __construct(
        int     $id,
        string  $url,
        ?int    $height = null,
        ?int    $width = null,
        ?string $name = null,
        ?string $type = null,
        ?int    $size = null,
        ?string $blurHash = null
    )
    {
        $this->id = $id;
        $this->url = $url;
        $this->height = $height;
        $this->width = $width;
        $this->name = $name;
        $this->type = $type;
        $this->size = $size;
        $this->blurHash = $blurHash;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['url'],
            $data['height'] ?? null,
            $data['width'] ?? null,
            $data['name'] ?? null,
            $data['type'] ?? null,
            $data['size'] ?? null,
            $data['blur_hash'] ?? null
        );
    }

    public function toArray(): array
    {
        $data = [
            'id' => $this->id,
            'url' => $this->url,
        ];

        if ($this->height !== null) {
            $data['height'] = $this->height;
        }
        if ($this->width !== null) {
            $data['width'] = $this->width;
        }
        if ($this->name !== null) {
            $data['name'] = $this->name;
        }
        if ($this->type !== null) {
            $data['type'] = $this->type;
        }
        if ($this->size !== null) {
            $data['size'] = $this->size;
        }
        if ($this->blurHash !== null) {
            $data['blur_hash'] = $this->blurHash;
        }

        return $data;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    // Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function getBlurHash(): ?string
    {
        return $this->blurHash;
    }
}