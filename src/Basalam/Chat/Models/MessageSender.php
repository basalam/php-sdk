<?php

namespace Basalam\Chat\Models;

class MessageSender implements \JsonSerializable
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['id']);
    }

    public function toArray(): array
    {
        return ['id' => $this->id];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function getId(): string
    {
        return $this->id;
    }
}