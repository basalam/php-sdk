<?php

namespace Basalam\Chat\Models;

/**
 * Contact model
 */
class Contact implements \JsonSerializable
{
    private int $id;
    private string $hashId;
    private string $name;
    private ?string $avatar;
    private ?string $badge;
    private bool $verified;
    private ?array $vendor;
    private ?string $description;

    public function __construct(
        int     $id,
        string  $hashId,
        string  $name,
        bool    $verified,
        ?string $avatar = null,
        ?string $badge = null,
        ?array  $vendor = null,
        ?string $description = null
    )
    {
        $this->id = $id;
        $this->hashId = $hashId;
        $this->name = $name;
        $this->verified = $verified;
        $this->avatar = $avatar;
        $this->badge = $badge;
        $this->vendor = $vendor;
        $this->description = $description;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['hash_id'],
            $data['name'],
            $data['verified'],
            $data['avatar'] ?? null,
            $data['badge'] ?? null,
            $data['vendor'] ?? null,
            $data['description'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->id,
            'hash_id' => $this->hashId,
            'name' => $this->name,
            'verified' => $this->verified
        ];

        if ($this->avatar !== null) {
            $result['avatar'] = $this->avatar;
        }
        if ($this->badge !== null) {
            $result['badge'] = $this->badge;
        }
        if ($this->vendor !== null) {
            $result['vendor'] = $this->vendor;
        }
        if ($this->description !== null) {
            $result['description'] = $this->description;
        }

        return $result;
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

    public function getHashId(): string
    {
        return $this->hashId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function getBadge(): ?string
    {
        return $this->badge;
    }

    public function isVerified(): bool
    {
        return $this->verified;
    }

    public function getVendor(): ?array
    {
        return $this->vendor;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}