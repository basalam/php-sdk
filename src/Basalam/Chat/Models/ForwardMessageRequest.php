<?php

namespace Basalam\Chat\Models;

class ForwardMessageRequest implements \JsonSerializable
{
    private array $messageIds;
    private array $chatIds;

    public function __construct(array $messageIds, array $chatIds)
    {
        $this->messageIds = $messageIds;
        $this->chatIds = $chatIds;
    }

    public function toArray(): array
    {
        return [
            'message_ids' => $this->messageIds,
            'chat_ids' => $this->chatIds,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
