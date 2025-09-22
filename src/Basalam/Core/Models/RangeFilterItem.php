<?php

namespace Basalam\Core\Models;

class RangeFilterItem implements \JsonSerializable
{
    public ?int $start;
    public ?int $end;

    public function __construct(array $data = [])
    {
        $this->start = $data['start'] ?? null;
        $this->end = $data['end'] ?? null;
    }

    public function toArray(): array
    {
        return array_filter([
            'start' => $this->start,
            'end' => $this->end,
        ], fn($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}