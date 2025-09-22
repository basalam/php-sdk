<?php

namespace Basalam\Chat\Models;

class MessageInput implements \JsonSerializable
{
    private ?string $text;
    private ?int $entityId;

    public function __construct(?string $text = null, ?int $entityId = null)
    {
        $this->text = $text;
        $this->entityId = $entityId;
    }

    public function toArray(): array
    {
        $data = [];

        if ($this->text !== null) {
            $data['text'] = $this->text;
        }

        if ($this->entityId !== null) {
            $data['entity_id'] = $this->entityId;
        }

        return $data;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function getEntityId(): ?int
    {
        return $this->entityId;
    }
}