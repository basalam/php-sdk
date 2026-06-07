<?php

namespace Basalam\Story\Models;

/**
 * UpdateReelBody model.
 */
class UpdateReelBody implements \JsonSerializable
{
    private ?array $productIds;
    private ?array $hashtags;

    public function __construct(
        ?array $productIds,
        ?array $hashtags
    ) {
        $this->productIds = $productIds;
        $this->hashtags = $hashtags;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['product_ids'] ?? null,
            $data['hashtags'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->productIds !== null) {
            $result['product_ids'] = $this->productIds;
        }
        if ($this->hashtags !== null) {
            $result['hashtags'] = $this->hashtags;
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getProductIds(): ?array
    {
        return $this->productIds;
    }

    public function getHashtags(): ?array
    {
        return $this->hashtags;
    }
}
