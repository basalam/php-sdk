<?php

namespace Basalam\Chat\Models;

/**
 * Chat response model for create_chat endpoint
 * Structure: { data: ChatResource }
 */
class CreateChatResponse implements \JsonSerializable
{
    private ChatResource $data;

    public function __construct(ChatResource $data)
    {
        $this->data = $data;
    }

    public static function fromArray(array $response): self
    {
        return new self(
            ChatResource::fromArray($response['data'])
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
    public function getData(): ChatResource
    {
        return $this->data;
    }
}