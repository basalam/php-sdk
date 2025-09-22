<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Customer hint model.
 */
class CustomerHint implements JsonSerializable
{
    private string $variant; // HintVariantEnum value
    private Hint $hint;

    public function __construct(string $variant, Hint $hint)
    {
        $this->variant = $variant;
        $this->hint = $hint;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['variant'],
            Hint::fromArray($data['hint'])
        );
    }

    public function toArray(): array
    {
        return [
            'variant' => $this->variant,
            'hint' => $this->hint->toArray(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}