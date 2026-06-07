<?php

namespace Basalam\Shipping\Models;

/**
 * ProductsResponseCursorPagination model.
 */
class ProductsResponseCursorPagination implements \JsonSerializable
{
    private array $data;
    private ?string $nextCursor;
    private ?string $previousCursor;

    public function __construct(
        array $data,
        ?string $nextCursor,
        ?string $previousCursor
    ) {
        $this->data = $data;
        $this->nextCursor = $nextCursor;
        $this->previousCursor = $previousCursor;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn($item) => ProductsResponse::fromArray($item), $data['data'] ?? []),
            $data['next_cursor'] ?? null,
            $data['previous_cursor'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['data'] = array_map(fn($item) => $item->toArray(), $this->data);
        $result['next_cursor'] = $this->nextCursor;
        $result['previous_cursor'] = $this->previousCursor;
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

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
}
