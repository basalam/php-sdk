<?php

namespace Basalam\Story\Models;

/**
 * MetadataLinkVersion3 model.
 */
class MetadataLinkVersion3 implements \JsonSerializable
{
    private ?string $link;
    private ?string $title;

    public function __construct(
        ?string $link,
        ?string $title
    ) {
        $this->link = $link;
        $this->title = $title;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['link'] ?? null,
            $data['title'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->link !== null) {
            $result['link'] = $this->link;
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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
}
