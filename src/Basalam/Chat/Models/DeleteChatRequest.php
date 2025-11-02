<?php

namespace Basalam\Chat\Models;

class DeleteChatRequest implements \JsonSerializable
{
    private array $chatIds;

    public function __construct(array $chatIds)
    {
        $this->chatIds = $chatIds;
    }

    public function toArray(): array
    {
        return [
            'chat_ids' => $this->chatIds,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
