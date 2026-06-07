<?php

namespace Basalam\Story\Models;

/**
 * CreateStoryBody model.
 */
class CreateStoryBody implements \JsonSerializable
{
    private ?int $photoId;
    private ?int $videoId;
    private ?array $hashtags;
    private ?array $products;
    private ?MetadataLinkVersion3 $link;

    public function __construct(
        ?int $photoId,
        ?int $videoId,
        ?array $hashtags,
        ?array $products,
        ?MetadataLinkVersion3 $link
    ) {
        $this->photoId = $photoId;
        $this->videoId = $videoId;
        $this->hashtags = $hashtags;
        $this->products = $products;
        $this->link = $link;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['photo_id'] ?? null,
            $data['video_id'] ?? null,
            $data['hashtags'] ?? null,
            $data['products'] ?? null,
            isset($data['link']) ? MetadataLinkVersion3::fromArray($data['link']) : null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->photoId !== null) {
            $result['photo_id'] = $this->photoId;
        }
        if ($this->videoId !== null) {
            $result['video_id'] = $this->videoId;
        }
        if ($this->hashtags !== null) {
            $result['hashtags'] = $this->hashtags;
        }
        if ($this->products !== null) {
            $result['products'] = $this->products;
        }
        if ($this->link !== null) {
            $result['link'] = $this->link->toArray();
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getPhotoId(): ?int
    {
        return $this->photoId;
    }

    public function getVideoId(): ?int
    {
        return $this->videoId;
    }

    public function getHashtags(): ?array
    {
        return $this->hashtags;
    }

    public function getProducts(): ?array
    {
        return $this->products;
    }

    public function getLink(): ?MetadataLinkVersion3
    {
        return $this->link;
    }
}
