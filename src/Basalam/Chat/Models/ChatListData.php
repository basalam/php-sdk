<?php

namespace Basalam\Chat\Models;

/**
 * Chat list data model
 */
class ChatListData implements \JsonSerializable
{
    private array $chats;

    public function __construct(array $chats)
    {
        $this->chats = $chats;
    }

    public static function fromArray(array $data): self
    {
        $chats = [];
        foreach ($data['chats'] as $chat) {
            $chats[] = ChatResponse::fromArray($chat);
        }
        return new self($chats);
    }

    public function toArray(): array
    {
        return [
            'chats' => array_map(fn($chat) => $chat->toArray(), $this->chats)
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    // Getter
    public function getChats(): array
    {
        return $this->chats;
    }
}