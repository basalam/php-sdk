<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * City model.
 */
class City implements JsonSerializable
{
    private int $id;
    private string $title;
    private ?City $parent;

    public function __construct(int $id, string $title, ?City $parent = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->parent = $parent;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['title'],
            isset($data['parent']) ? self::fromArray($data['parent']) : null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'parent' => $this->parent?->toArray(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}