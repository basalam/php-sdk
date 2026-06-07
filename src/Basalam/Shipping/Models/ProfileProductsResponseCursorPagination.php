<?php

namespace Basalam\Shipping\Models;

/**
 * ProfileProductsResponseCursorPagination model.
 */
class ProfileProductsResponseCursorPagination implements \JsonSerializable
{
    private array $data;
    private int $totalCount;
    private ?string $nextCursor;
    private ?string $previousCursor;

    public function __construct(
        array $data,
        int $totalCount,
        ?string $nextCursor,
        ?string $previousCursor
    ) {
        $this->data = $data;
        $this->totalCount = $totalCount;
        $this->nextCursor = $nextCursor;
        $this->previousCursor = $previousCursor;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn($item) => ProductResponse::fromArray($item), $data['data'] ?? []),
            $data['total_count'],
            $data['next_cursor'] ?? null,
            $data['previous_cursor'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['data'] = array_map(fn($item) => $item->toArray(), $this->data);
        $result['total_count'] = $this->totalCount;
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

    public function getTotalCount(): int
    {
        return $this->totalCount;
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
