<?php

namespace Basalam\Apps\Models;

/**
 * StatusObjectResource model.
 */
class StatusObjectResource implements \JsonSerializable
{
    private ?int $id;
    private ?string $title;

    public function __construct(
        ?int $id,
        ?string $title
    ) {
        $this->id = $id;
        $this->title = $title;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['title'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->id !== null) {
            $result['id'] = $this->id;
        }
        if ($this->title !== null) {
            $result['title'] = $this->title;
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
}
