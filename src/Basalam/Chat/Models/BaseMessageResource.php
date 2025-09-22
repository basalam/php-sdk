<?php

namespace Basalam\Chat\Models;

/**
 * Base message resource model
 */
class BaseMessageResource implements \JsonSerializable
{
    private int $id;
    private int $chatId;
    private string $seenAt;
    private string $createdAt;
    private string $updatedAt;
    private string $messageType;
    private MessageSender $sender;
    private MessageContent $content;

    public function __construct(
        int            $id,
        int            $chatId,
        string         $seenAt,
        string         $createdAt,
        string         $updatedAt,
        string         $messageType,
        MessageSender  $sender,
        MessageContent $content
    )
    {
        $this->id = $id;
        $this->chatId = $chatId;
        $this->seenAt = $seenAt;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->messageType = $messageType;
        $this->sender = $sender;
        $this->content = $content;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['chat_id'],
            $data['seen_at'],
            $data['created_at'],
            $data['updated_at'],
            $data['message_type'],
            MessageSender::fromArray($data['sender']),
            MessageContent::fromArray($data['content'])
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'chat_id' => $this->chatId,
            'seen_at' => $this->seenAt,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'message_type' => $this->messageType,
            'sender' => $this->sender->toArray(),
            'content' => $this->content->toArray()
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getChatId(): int
    {
        return $this->chatId;
    }

    public function getSeenAt(): string
    {
        return $this->seenAt;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getMessageType(): string
    {
        return $this->messageType;
    }

    public function getSender(): MessageSender
    {
        return $this->sender;
    }

    public function getContent(): MessageContent
    {
        return $this->content;
    }
}