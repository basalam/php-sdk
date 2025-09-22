<?php

namespace Basalam\Chat\Models;

/**
 * Create chat request model
 */
class CreateChatRequest implements \JsonSerializable
{
    private ?int $userId;
    private ?string $hashId;

    public function __construct(?int $userId = null, ?string $hashId = null)
    {
        $this->userId = $userId;
        $this->hashId = $hashId;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['user_id'] ?? null,
            $data['hash_id'] ?? null
        );
    }

    public function toArray(): array
    {
        $data = [];

        if ($this->userId !== null) {
            $data['user_id'] = $this->userId;
        }

        if ($this->hashId !== null) {
            $data['hash_id'] = $this->hashId;
        }

        return $data;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}