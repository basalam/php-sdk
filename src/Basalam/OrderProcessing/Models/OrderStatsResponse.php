<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Order statistics response model.
 */
class OrderStatsResponse implements JsonSerializable
{
    private int $result;

    public function __construct(int $result)
    {
        $this->result = $result;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['result']);
    }

    public function getResult(): int
    {
        return $this->result;
    }

    public function toArray(): array
    {
        return [
            'result' => $this->result,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}