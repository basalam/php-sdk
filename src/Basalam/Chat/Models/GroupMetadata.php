<?php

namespace Basalam\Chat\Models;

/**
 * Group metadata model
 */
class GroupMetadata implements \JsonSerializable
{
    private string $title;
    private ?string $description;
    private ?string $avatar;
    private string $link;
    private int $creatorId;
    private int $id;
    private int $chatId;

    public function __construct(
        string  $title,
        string  $link,
        int     $creatorId,
        int     $id,
        int     $chatId,
        ?string $description = null,
        ?string $avatar = null
    )
    {
        $this->title = $title;
        $this->link = $link;
        $this->creatorId = $creatorId;
        $this->id = $id;
        $this->chatId = $chatId;
        $this->description = $description;
        $this->avatar = $avatar;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['title'],
            $data['link'],
            $data['creator_id'],
            $data['id'],
            $data['chat_id'],
            $data['description'] ?? null,
            $data['avatar'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [
            'title' => $this->title,
            'link' => $this->link,
            'creator_id' => $this->creatorId,
            'id' => $this->id,
            'chat_id' => $this->chatId
        ];

        if ($this->description !== null) {
            $result['description'] = $this->description;
        }
        if ($this->avatar !== null) {
            $result['avatar'] = $this->avatar;
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    // Getters
    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getCreatorId(): int
    {
        return $this->creatorId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getChatId(): int
    {
        return $this->chatId;
    }
}