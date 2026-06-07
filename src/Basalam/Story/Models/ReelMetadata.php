<?php

namespace Basalam\Story\Models;

/**
 * ReelMetadata model.
 */
class ReelMetadata implements \JsonSerializable
{
    private ?MetadataLink $link;
    private ?array $links;
    private ?string $instagramReelId;

    public function __construct(
        ?MetadataLink $link,
        ?array $links,
        ?string $instagramReelId
    ) {
        $this->link = $link;
        $this->links = $links;
        $this->instagramReelId = $instagramReelId;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['link']) ? MetadataLink::fromArray($data['link']) : null,
            isset($data['links']) ? array_map(fn($item) => MetadataLink::fromArray($item), $data['links']) : null,
            $data['instagram_reel_id'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->link !== null) {
            $result['link'] = $this->link->toArray();
        }
        if ($this->links !== null) {
            $result['links'] = array_map(fn($item) => $item->toArray(), $this->links);
        }
        if ($this->instagramReelId !== null) {
            $result['instagram_reel_id'] = $this->instagramReelId;
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getLink(): ?MetadataLink
    {
        return $this->link;
    }

    public function getLinks(): ?array
    {
        return $this->links;
    }

    public function getInstagramReelId(): ?string
    {
        return $this->instagramReelId;
    }
}
