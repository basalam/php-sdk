<?php

namespace Basalam\Chat\Models;

/**
 * Response model for chat list endpoint
 * Structure: { data: { chats: ChatResponse[] } }
 */
class ChatListResponse implements \JsonSerializable
{
    private ChatListData $data;

    public function __construct(ChatListData $data)
    {
        $this->data = $data;
    }

    public static function fromArray(array $response): self
    {
        return new self(
            ChatListData::fromArray($response['data'])
        );
    }

    public function toArray(): array
    {
        return [
            'data' => $this->data->toArray()
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    // Getter
    public function getData(): ChatListData
    {
        return $this->data;
    }
}

