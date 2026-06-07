<?php

namespace Basalam\Shipping\Models;

/**
 * BulkResponseNestedLocationResponse model.
 */
class BulkResponseNestedLocationResponse implements \JsonSerializable
{
    private array $data;

    public function __construct(
        array $data
    ) {
        $this->data = $data;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn($item) => NestedLocationResponse::fromArray($item), $data['data'] ?? [])
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['data'] = array_map(fn($item) => $item->toArray(), $this->data);
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
}
