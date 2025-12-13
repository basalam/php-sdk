<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Generic response wrapper that exposes the result payload from public endpoints.
 */
class ResultResponse implements JsonSerializable
{
    /**
     * @var mixed
     */
    private mixed $result;

    public function __construct(mixed $result)
    {
        $this->result = $result;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['result'] ?? null);
    }

    public function getResult(): mixed
    {
        return $this->result;
    }

    public function toArray(): array
    {
        return ['result' => $this->result];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
