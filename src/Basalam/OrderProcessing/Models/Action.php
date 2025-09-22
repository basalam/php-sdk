<?php

namespace Basalam\OrderProcessing\Models;

/**
 * Action model.
 */
class Action
{
    private ?string $icon;
    private ?string $variant;
    private string $key;
    private string $title;

    public function __construct(
        string  $key,
        string  $title,
        ?string $icon = null,
        ?string $variant = null
    )
    {
        $this->key = $key;
        $this->title = $title;
        $this->icon = $icon;
        $this->variant = $variant;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['key'],
            $data['title'],
            $data['icon'] ?? null,
            $data['variant'] ?? null
        );
    }
}

