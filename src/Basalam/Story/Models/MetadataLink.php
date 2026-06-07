<?php

namespace Basalam\Story\Models;

/**
 * MetadataLink model.
 */
class MetadataLink implements \JsonSerializable
{
    private string $link;
    private string $title;

    public function __construct(
        string $link,
        string $title
    ) {
        $this->link = $link;
        $this->title = $title;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['link'],
            $data['title']
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['link'] = $this->link;
        $result['title'] = $this->title;
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
