<?php

namespace Basalam\Chat\Models;

/**
 * Message response model for create_message endpoint
 * Structure: { data: MessageResource, temp_id?: int }
 */
class MessageResponse implements \JsonSerializable
{
    private MessageResource $data;
    private ?int $tempId;

    public function __construct(MessageResource $data, ?int $tempId = null)
    {
        $this->data = $data;
        $this->tempId = $tempId;
    }

    public static function fromArray(array $response): self
    {
        return new self(
            MessageResource::fromArray($response['data']),
            $response['temp_id'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [
            'data' => $this->data->toArray()
        ];

        if ($this->tempId !== null) {
            $result['temp_id'] = $this->tempId;
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    // Getters
    public function getData(): MessageResource
    {
        return $this->data;
    }

    public function getTempId(): ?int
    {
        return $this->tempId;
    }
}