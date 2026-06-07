<?php

namespace Basalam\Chat\Models;

class MessageInput implements \JsonSerializable
{
    private ?string $text;
    private ?int $entityId;
    private ?int $quickMessageId;

    public function __construct(?string $text = null, ?int $entityId = null, ?int $quickMessageId = null)
    {
        $this->text = $text;
        $this->entityId = $entityId;
        $this->quickMessageId = $quickMessageId;
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

        if ($this->quickMessageId !== null) {
            $data['quick_message_id'] = $this->quickMessageId;
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

    public function getQuickMessageId(): ?int
    {
        return $this->quickMessageId;
    }
}