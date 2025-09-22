<?php

namespace Basalam\Chat\Models;

class MessageFile implements \JsonSerializable
{
    private int $id;
    private string $url;
    private ?string $name;
    private ?int $size;
    private ?string $type;
    private ?int $width;
    private ?int $height;
    private ?string $blurHash;

    public function __construct(
        int     $id,
        string  $url,
        ?string $name = null,
        ?int    $size = null,
        ?string $type = null,
        ?int    $width = null,
        ?int    $height = null,
        ?string $blurHash = null
    )
    {
        $this->id = $id;
        $this->url = $url;
        $this->name = $name;
        $this->size = $size;
        $this->type = $type;
        $this->width = $width;
        $this->height = $height;
        $this->blurHash = $blurHash;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['url'],
            $data['name'] ?? null,
            $data['size'] ?? null,
            $data['type'] ?? null,
            $data['width'] ?? null,
            $data['height'] ?? null,
            $data['blur_hash'] ?? null
        );
    }

    public function toArray(): array
    {
        $data = [
            'id' => $this->id,
            'url' => $this->url,
        ];

        if ($this->name !== null) $data['name'] = $this->name;
        if ($this->size !== null) $data['size'] = $this->size;
        if ($this->type !== null) $data['type'] = $this->type;
        if ($this->width !== null) $data['width'] = $this->width;
        if ($this->height !== null) $data['height'] = $this->height;
        if ($this->blurHash !== null) $data['blur_hash'] = $this->blurHash;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function getBlurHash(): ?string
    {
        return $this->blurHash;
    }
}