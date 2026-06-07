<?php

namespace Basalam\Story\Models;

/**
 * LikeReelBody model.
 */
class LikeReelBody implements \JsonSerializable
{
    private ?bool $like;

    public function __construct(
        ?bool $like
    ) {
        $this->like = $like;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['like'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->like !== null) {
            $result['like'] = $this->like;
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getLike(): ?bool
    {
        return $this->like;
    }
}
