<?php

namespace Basalam\Chat\Models;

/**
 * Message resource model
 */
class MessageResource implements \JsonSerializable
{
    private int $id;
    private int $chatId;
    private ?string $seenAt;
    private string $createdAt;
    private string $updatedAt;
    private string $messageType;
    private MessageSender $sender;
    private MessageContent $content;
    private ?BaseMessageResource $repliedMessage;

    public function __construct(
        int                  $id,
        int                  $chatId,
        string               $createdAt,
        string               $updatedAt,
        string               $messageType,
        MessageSender        $sender,
        MessageContent       $content,
        ?string              $seenAt = null,
        ?BaseMessageResource $repliedMessage = null
    )
    {
        $this->id = $id;
        $this->chatId = $chatId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->messageType = $messageType;
        $this->sender = $sender;
        $this->content = $content;
        $this->seenAt = $seenAt;
        $this->repliedMessage = $repliedMessage;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['chat_id'],
            $data['created_at'],
            $data['updated_at'],
            $data['message_type'],
            MessageSender::fromArray($data['sender']),
            MessageContent::fromArray($data['content']),
            $data['seen_at'] ?? null,
            isset($data['replied_message']) ? BaseMessageResource::fromArray($data['replied_message']) : null
        );
    }

    public function toArray(): array
    {
        $data = [
            'id' => $this->id,
            'chat_id' => $this->chatId,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'message_type' => $this->messageType,
            'sender' => $this->sender->toArray(),
            'content' => $this->content->toArray()
        ];

        if ($this->seenAt !== null) {
            $data['seen_at'] = $this->seenAt;
        }

        if ($this->repliedMessage !== null) {
            $data['replied_message'] = $this->repliedMessage->toArray();
        }

        return $data;
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

    public function getSeenAt(): ?string
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

    public function getRepliedMessage(): ?BaseMessageResource
    {
        return $this->repliedMessage;
    }
}