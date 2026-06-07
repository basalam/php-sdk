<?php

namespace Basalam\Chat\Models;

class MessageSender implements \JsonSerializable
{
    private string $id;
    private ?string $hashId;
    private ?string $name;
    private ?string $avatar;
    private ?array $badge;
    private ?bool $verified;
    private ?array $vendor;
    private ?string $description;

    public function __construct(
        string  $id,
        ?string $hashId = null,
        ?string $name = null,
        ?string $avatar = null,
        ?array  $badge = null,
        ?bool   $verified = null,
        ?array  $vendor = null,
        ?string $description = null
    )
    {
        $this->id = $id;
        $this->hashId = $hashId;
        $this->name = $name;
        $this->avatar = $avatar;
        $this->badge = $badge;
        $this->verified = $verified;
        $this->vendor = $vendor;
        $this->description = $description;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['hash_id'] ?? null,
            $data['name'] ?? null,
            $data['avatar'] ?? null,
            $data['badge'] ?? null,
            $data['verified'] ?? null,
            $data['vendor'] ?? null,
            $data['description'] ?? null
        );
    }

    public function toArray(): array
    {
        $data = ['id' => $this->id];

        if ($this->hashId !== null) {
            $data['hash_id'] = $this->hashId;
        }
        if ($this->name !== null) {
            $data['name'] = $this->name;
        }
        if ($this->avatar !== null) {
            $data['avatar'] = $this->avatar;
        }
        if ($this->badge !== null) {
            $data['badge'] = $this->badge;
        }
        if ($this->verified !== null) {
            $data['verified'] = $this->verified;
        }
        if ($this->vendor !== null) {
            $data['vendor'] = $this->vendor;
        }
        if ($this->description !== null) {
            $data['description'] = $this->description;
        }

        return $data;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getHashId(): ?string
    {
        return $this->hashId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function getBadge(): ?array
    {
        return $this->badge;
    }

    public function isVerified(): ?bool
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
