<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Post receipt attachment model.
 */
class PostReceiptAttachment implements JsonSerializable
{
    private int $id;
    private string $original;
    private ?string $format;
    private array $resized;

    public function __construct(
        int     $id,
        string  $original,
        array   $resized,
        ?string $format = null
    )
    {
        $this->id = $id;
        $this->original = $original;
        $this->resized = $resized;
        $this->format = $format;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['original'],
            $data['resized'],
            $data['format'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'original' => $this->original,
            'format' => $this->format,
            'resized' => $this->resized,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}