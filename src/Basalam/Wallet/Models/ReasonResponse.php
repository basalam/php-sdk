<?php

namespace Basalam\Wallet\Models;

/**
 * Reason response model.
 */
class ReasonResponse implements \JsonSerializable
{
    private int $id;
    private string $description;

    public function __construct(int $id, string $description)
    {
        $this->id = $id;
        $this->description = $description;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['description']
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}