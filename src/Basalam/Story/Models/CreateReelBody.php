<?php

namespace Basalam\Story\Models;

/**
 * CreateReelBody model.
 */
class CreateReelBody implements \JsonSerializable
{
    private ?string $type;
    private int $videoId;
    private ?array $productIds;
    private ?array $hashtags;
    private ?ReelMetadata $metadata;

    public function __construct(
        ?string $type,
        int $videoId,
        ?array $productIds,
        ?array $hashtags,
        ?ReelMetadata $metadata
    ) {
        $this->type = $type;
        $this->videoId = $videoId;
        $this->productIds = $productIds;
        $this->hashtags = $hashtags;
        $this->metadata = $metadata;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['type'] ?? null,
            $data['video_id'],
            $data['product_ids'] ?? null,
            $data['hashtags'] ?? null,
            isset($data['metadata']) ? ReelMetadata::fromArray($data['metadata']) : null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->type !== null) {
            $result['type'] = $this->type;
        }
        $result['video_id'] = $this->videoId;
        if ($this->productIds !== null) {
            $result['product_ids'] = $this->productIds;
        }
        if ($this->hashtags !== null) {
            $result['hashtags'] = $this->hashtags;
        }
        if ($this->metadata !== null) {
            $result['metadata'] = $this->metadata->toArray();
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getVideoId(): int
    {
        return $this->videoId;
    }

    public function getProductIds(): ?array
    {
        return $this->productIds;
    }

    public function getHashtags(): ?array
    {
        return $this->hashtags;
    }

    public function getMetadata(): ?ReelMetadata
    {
        return $this->metadata;
    }
}
