<?php

namespace Basalam\Apps\Models;

/**
 * EnumObjectResource model.
 */
class EnumObjectResource implements \JsonSerializable
{
    private ?string $slug;
    private ?string $title;

    public function __construct(
        ?string $slug,
        ?string $title
    ) {
        $this->slug = $slug;
        $this->title = $title;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['slug'] ?? null,
            $data['title'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->slug !== null) {
            $result['slug'] = $this->slug;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
}
