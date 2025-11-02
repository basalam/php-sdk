<?php

namespace Basalam\Chat\Models;

class BooleanResponse implements \JsonSerializable
{
    private bool $data;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->data = $data['data'];
        return $instance;
    }

    public function getData(): bool
    {
        return $this->data;
    }

    public function toArray(): array
    {
        return [
            'data' => $this->data,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
