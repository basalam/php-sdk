<?php

namespace Basalam\Apps\Models;

/**
 * TransactionStatusResource model.
 */
class TransactionStatusResource implements \JsonSerializable
{
    private ?int $id;
    private ?string $title;
    private ?string $slug;

    public function __construct(
        ?int $id,
        ?string $title,
        ?string $slug
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->slug = $slug;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['title'] ?? null,
            $data['slug'] ?? null
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
        if ($this->slug !== null) {
            $result['slug'] = $this->slug;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }
}
