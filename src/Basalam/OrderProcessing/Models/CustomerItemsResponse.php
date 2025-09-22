<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Customer items list response model.
 */
class CustomerItemsResponse implements JsonSerializable
{
    private array $data;
    private ?string $nextCursor;
    private ?string $previousCursor;

    public function __construct(array $data, ?string $nextCursor = null, ?string $previousCursor = null)
    {
        $this->data = $data;
        $this->nextCursor = $nextCursor;
        $this->previousCursor = $previousCursor;
    }

    public static function fromArray(array $data): self
    {
        $items = array_map(fn($item) => CustomerItemResponse::fromArray($item), $data['data']);

        return new self(
            $items,
            $data['next_cursor'] ?? null,
            $data['previous_cursor'] ?? null
        );
    }

    // Getters
    public function getData(): array
    {
        return $this->data;
    }

    public function getNextCursor(): ?string
    {
        return $this->nextCursor;
    }

    public function getPreviousCursor(): ?string
    {
        return $this->previousCursor;
    }

    public function toArray(): array
    {
        return [
            'data' => array_map(fn($item) => $item->toArray(), $this->data),
            'next_cursor' => $this->nextCursor,
            'previous_cursor' => $this->previousCursor,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}