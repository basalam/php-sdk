<?php

namespace Basalam\Chat\Models;

/**
 * Channel metadata model
 */
class ChannelMetadata implements \JsonSerializable
{
    private string $title;
    private ?string $description;
    private ?string $avatar;
    private ?string $link;
    private int $owner;
    private bool $isAdmin;
    private ?int $membersCount;
    private bool $canLeave;
    private bool $verified;

    public function __construct(
        string  $title,
        int     $owner,
        bool    $isAdmin = false,
        bool    $canLeave = true,
        bool    $verified = true,
        ?string $description = null,
        ?string $avatar = null,
        ?string $link = null,
        ?int    $membersCount = null
    )
    {
        $this->title = $title;
        $this->owner = $owner;
        $this->isAdmin = $isAdmin;
        $this->canLeave = $canLeave;
        $this->verified = $verified;
        $this->description = $description;
        $this->avatar = $avatar;
        $this->link = $link;
        $this->membersCount = $membersCount;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['title'],
            $data['owner'],
            $data['is_admin'] ?? false,
            $data['can_leave'] ?? true,
            $data['verified'] ?? true,
            $data['description'] ?? null,
            $data['avatar'] ?? null,
            $data['link'] ?? null,
            $data['members_count'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [
            'title' => $this->title,
            'owner' => $this->owner,
            'is_admin' => $this->isAdmin,
            'can_leave' => $this->canLeave,
            'verified' => $this->verified
        ];

        if ($this->description !== null) {
            $result['description'] = $this->description;
        }
        if ($this->avatar !== null) {
            $result['avatar'] = $this->avatar;
        }
        if ($this->link !== null) {
            $result['link'] = $this->link;
        }
        if ($this->membersCount !== null) {
            $result['members_count'] = $this->membersCount;
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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function getOwner(): int
    {
        return $this->owner;
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function getMembersCount(): ?int
    {
        return $this->membersCount;
    }

    public function canLeave(): bool
    {
        return $this->canLeave;
    }

    public function isVerified(): bool
    {
        return $this->verified;
    }
}