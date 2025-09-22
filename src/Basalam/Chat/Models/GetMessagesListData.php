<?php

namespace Basalam\Chat\Models;

/**
 * Get messages list data model
 */
class GetMessagesListData implements \JsonSerializable
{
    private array $messages;

    public function __construct(array $messages)
    {
        $this->messages = $messages;
    }

    public static function fromArray(array $data): self
    {
        $messages = [];
        foreach ($data['messages'] as $message) {
            $messages[] = MessageResource::fromArray($message);
        }
        return new self($messages);
    }

    public function toArray(): array
    {
        return [
            'messages' => array_map(fn($msg) => $msg->toArray(), $this->messages)
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    // Getter
    public function getMessages(): array
    {
        return $this->messages;
    }
}