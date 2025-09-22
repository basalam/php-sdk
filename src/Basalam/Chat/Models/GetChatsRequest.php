<?php

namespace Basalam\Chat\Models;

/**
 * Get chats request model
 */
class GetChatsRequest implements \JsonSerializable
{
    private int $limit;
    private string $orderBy;
    private ?string $updatedFrom;
    private ?string $updatedBefore;
    private ?string $modifiedFrom;
    private ?string $modifiedBefore;
    private ?string $filters;

    public function __construct(
        int     $limit = 30,
        string  $orderBy = \Basalam\Chat\Models\MessageOrderByEnum::UPDATED_AT,
        ?string $updatedFrom = null,
        ?string $updatedBefore = null,
        ?string $modifiedFrom = null,
        ?string $modifiedBefore = null,
        ?string $filters = null
    )
    {
        $this->limit = $limit;
        $this->orderBy = $orderBy;
        $this->updatedFrom = $updatedFrom;
        $this->updatedBefore = $updatedBefore;
        $this->modifiedFrom = $modifiedFrom;
        $this->modifiedBefore = $modifiedBefore;
        $this->filters = $filters;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['limit'] ?? 30,
            $data['order_by'] ?? \Basalam\Chat\Models\MessageOrderByEnum::UPDATED_AT,
            $data['updated_from'] ?? null,
            $data['updated_before'] ?? null,
            $data['modified_from'] ?? null,
            $data['modified_before'] ?? null,
            $data['filters'] ?? null
        );
    }

    public function toArray(): array
    {
        $params = [
            'limit' => $this->limit,
            'order_by' => $this->orderBy
        ];

        if ($this->updatedFrom !== null) {
            $params['updated_from'] = $this->updatedFrom;
        }

        if ($this->updatedBefore !== null) {
            $params['updated_before'] = $this->updatedBefore;
        }

        if ($this->modifiedFrom !== null) {
            $params['modified_from'] = $this->modifiedFrom;
        }

        if ($this->modifiedBefore !== null) {
            $params['modified_before'] = $this->modifiedBefore;
        }

        if ($this->filters !== null) {
            $params['filters'] = $this->filters;
        }

        return $params;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}