<?php

namespace Basalam\Chat\Models;

class EditMessageRequest implements \JsonSerializable
{
    private int $messageId;
    private ?MessageInput $content;

    public function __construct(
        int           $messageId,
        ?MessageInput $content = null
    )
    {
        $this->messageId = $messageId;
        $this->content = $content;
    }

    public function toArray(): array
    {
        $data = [
            'message_id' => $this->messageId,
        ];

        if ($this->content !== null) {
            $data['content'] = $this->content->toArray();
        }

        return $data;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
