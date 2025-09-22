<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Item last status model.
 */
class ItemLastStatus implements JsonSerializable
{
    private int $id;
    private ItemStatus $status;
    private ItemStatusOperator $operator;
    private ?string $description;
    private ?string $createdAt;
    private array $details;

    public function __construct(
        int                $id,
        ItemStatus         $status,
        ItemStatusOperator $operator,
        array              $details,
        ?string            $description = null,
        ?string            $createdAt = null
    )
    {
        $this->id = $id;
        $this->status = $status;
        $this->operator = $operator;
        $this->details = $details;
        $this->description = $description;
        $this->createdAt = $createdAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            ItemStatus::fromArray($data['status']),
            ItemStatusOperator::fromArray($data['operator']),
            $data['details'],
            $data['description'] ?? null,
            $data['created_at'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status->toArray(),
            'operator' => $this->operator->toArray(),
            'description' => $this->description,
            'created_at' => $this->createdAt,
            'details' => $this->details,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}