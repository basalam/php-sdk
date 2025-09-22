<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * User model.
 */
class User implements JsonSerializable
{
    private int $id;
    private string $hashId;
    private string $name;
    private ?FileResponse $avatar;

    public function __construct(
        int           $id,
        string        $hashId,
        string        $name,
        ?FileResponse $avatar = null
    )
    {
        $this->id = $id;
        $this->hashId = $hashId;
        $this->name = $name;
        $this->avatar = $avatar;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['hash_id'],
            $data['name'],
            isset($data['avatar']) ? FileResponse::fromArray($data['avatar']) : null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'hash_id' => $this->hashId,
            'name' => $this->name,
            'avatar' => $this->avatar?->toArray(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}