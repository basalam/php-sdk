<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Property value model.
 */
class PropertyValue implements JsonSerializable
{
    private int $id;
    private string $title;
    private string $value;

    public function __construct(int $id, string $title, string $value)
    {
        $this->id = $id;
        $this->title = $title;
        $this->value = $value;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['id'], $data['title'], $data['value']);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'value' => $this->value,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}