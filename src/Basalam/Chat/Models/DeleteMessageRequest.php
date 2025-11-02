<?php

namespace Basalam\Chat\Models;

class DeleteMessageRequest implements \JsonSerializable
{
    private array $messageIds;

    public function __construct(array $messageIds)
    {
        $this->messageIds = $messageIds;
    }

    public function toArray(): array
    {
        return [
            'message_ids' => $this->messageIds,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
