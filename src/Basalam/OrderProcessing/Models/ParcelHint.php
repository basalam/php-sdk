<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Parcel hint model.
 */
class ParcelHint implements JsonSerializable
{
    private int $id;
    private ?CustomerHint $hintBar;

    public function __construct(int $id, ?CustomerHint $hintBar = null)
    {
        $this->id = $id;
        $this->hintBar = $hintBar;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            isset($data['hint_bar']) ? CustomerHint::fromArray($data['hint_bar']) : null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'hint_bar' => $this->hintBar?->toArray(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}