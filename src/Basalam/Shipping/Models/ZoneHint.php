<?php

namespace Basalam\Shipping\Models;

/**
 * ZoneHint model.
 */
class ZoneHint implements \JsonSerializable
{
    private ?string $title;
    private string $text;
    private ?string $icon;
    private string $variant;

    public function __construct(
        ?string $title,
        string $text,
        ?string $icon,
        string $variant
    ) {
        $this->title = $title;
        $this->text = $text;
        $this->icon = $icon;
        $this->variant = $variant;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['title'] ?? null,
            $data['text'],
            $data['icon'] ?? null,
            $data['variant']
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->title !== null) {
            $result['title'] = $this->title;
        }
        $result['text'] = $this->text;
        if ($this->icon !== null) {
            $result['icon'] = $this->icon;
        }
        $result['variant'] = $this->variant;
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

    public function getText(): string
    {
        return $this->text;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function getVariant(): string
    {
        return $this->variant;
    }
}
