<?php

namespace Basalam\OrderProcessing\Models;

/**
 * File response model.
 */
class FileResponse implements \JsonSerializable
{
    private int $id;
    private string $original;
    private ?string $format;
    private array $resized;

    public function __construct(
        int     $id,
        string  $original,
        ?string $format,
        array   $resized
    )
    {
        $this->id = $id;
        $this->original = $original;
        $this->format = $format;
        $this->resized = $resized;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['original'],
            $data['format'] ?? null,
            $data['resized']
        );
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->id,
            'original' => $this->original,
            'resized' => $this->resized,
        ];

        if ($this->format !== null) {
            $result['format'] = $this->format;
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getOriginal(): string
    {
        return $this->original;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function getResized(): array
    {
        return $this->resized;
    }
}