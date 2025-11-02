<?php

namespace Basalam\Chat\Models;

class UnseenChatCountResponse implements \JsonSerializable
{
    private int $count;
    private bool $moreThanCount;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->count = $data['count'];
        $instance->moreThanCount = $data['more_than_count'];
        return $instance;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getMoreThanCount(): bool
    {
        return $this->moreThanCount;
    }

    public function toArray(): array
    {
        return [
            'count' => $this->count,
            'more_than_count' => $this->moreThanCount,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
