<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Property model.
 */
class Property implements JsonSerializable
{
    private int $id;
    private string $title;
    private string $type;

    public function __construct(int $id, string $title, string $type)
    {
        $this->id = $id;
        $this->title = $title;
        $this->type = $type;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['id'], $data['title'], $data['type']);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}