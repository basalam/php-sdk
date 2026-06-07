<?php

namespace Basalam\Shipping\Models;

/**
 * UpdateProfileRequest model.
 */
class UpdateProfileRequest implements \JsonSerializable
{
    private ?string $title;

    public function __construct(
        ?string $title
    ) {
        $this->title = $title;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['title'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->title !== null) {
            $result['title'] = $this->title;
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
}
