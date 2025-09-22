<?php

namespace Basalam\Chat\Models;

class MessageRequest implements \JsonSerializable
{
    private int $chatId;
    private ?MessageInput $content;
    private string $messageType;
    private ?Attachment $attachment;
    private ?int $repliedMessageId;
    private ?array $messageMetadata;
    private ?int $tempId;

    public function __construct(
        int           $chatId,
        string        $messageType,
        ?MessageInput $content = null,
        ?Attachment   $attachment = null,
        ?int          $repliedMessageId = null,
        ?array        $messageMetadata = null,
        ?int          $tempId = null
    )
    {
        $this->chatId = $chatId;
        $this->messageType = $messageType;
        $this->content = $content;
        $this->attachment = $attachment;
        $this->repliedMessageId = $repliedMessageId;
        $this->messageMetadata = $messageMetadata;
        $this->tempId = $tempId;
    }

    public function toArray(): array
    {
        $data = [
            'chat_id' => $this->chatId,
            'message_type' => $this->messageType,
        ];

        if ($this->content !== null) {
            $data['content'] = $this->content->toArray();
        }

        if ($this->attachment !== null) {
            $data['attachment'] = $this->attachment->toArray();
        }

        if ($this->repliedMessageId !== null) {
            $data['replied_message_id'] = $this->repliedMessageId;
        }

        if ($this->messageMetadata !== null) {
            $data['message_metadata'] = $this->messageMetadata;
        }

        if ($this->tempId !== null) {
            $data['temp_id'] = $this->tempId;
        }

        return $data;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}