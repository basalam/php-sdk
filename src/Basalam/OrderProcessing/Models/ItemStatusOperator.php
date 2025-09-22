<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Item status operator model.
 */
class ItemStatusOperator implements JsonSerializable
{
    private int $id;
    private string $title;

    public function __construct(int $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['id'], $data['title']);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}