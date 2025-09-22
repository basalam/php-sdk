<?php

namespace Basalam\Chat\Models;

class MessageLink implements \JsonSerializable
{
    private string $url;
    private int $startIndex;
    private int $endIndex;
    private bool $isBasalamLink;

    public function __construct(
        string $url,
        int    $startIndex,
        int    $endIndex,
        bool   $isBasalamLink
    )
    {
        $this->url = $url;
        $this->startIndex = $startIndex;
        $this->endIndex = $endIndex;
        $this->isBasalamLink = $isBasalamLink;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['url'],
            $data['start_index'],
            $data['end_index'],
            $data['is_basalam_link']
        );
    }

    public function toArray(): array
    {
        return [
            'url' => $this->url,
            'start_index' => $this->startIndex,
            'end_index' => $this->endIndex,
            'is_basalam_link' => $this->isBasalamLink,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    // Getters
    public function getUrl(): string
    {
        return $this->url;
    }

    public function getStartIndex(): int
    {
        return $this->startIndex;
    }

    public function getEndIndex(): int
    {
        return $this->endIndex;
    }

    public function isBasalamLink(): bool
    {
        return $this->isBasalamLink;
    }
}