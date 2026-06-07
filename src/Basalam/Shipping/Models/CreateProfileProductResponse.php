<?php

namespace Basalam\Shipping\Models;

/**
 * CreateProfileProductResponse model.
 */
class CreateProfileProductResponse implements \JsonSerializable
{
    private int $assignedCount;

    public function __construct(
        int $assignedCount
    ) {
        $this->assignedCount = $assignedCount;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['assigned_count']
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['assigned_count'] = $this->assignedCount;
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getAssignedCount(): int
    {
        return $this->assignedCount;
    }
}
