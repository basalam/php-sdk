<?php

namespace Basalam\Chat\Models;

/**
 * Get messages response model
 * Structure: { data: { messages: MessageResource[] } }
 */
class GetMessagesResponse implements \JsonSerializable
{
    private GetMessagesListData $data;

    public function __construct(GetMessagesListData $data)
    {
        $this->data = $data;
    }

    public static function fromArray(array $response): self
    {
        return new self(
            GetMessagesListData::fromArray($response['data'])
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
    public function getData(): GetMessagesListData
    {
        return $this->data;
    }
}