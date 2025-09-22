<?php

namespace Basalam\Wallet\Models;

use DateTime;

/**
 * History spend response model.
 */
class HistorySpendResponse implements \JsonSerializable
{
    private ?int $id;
    private ?DateTime $createdAt;
    private ?int $amount;
    private ?array $items;

    public function __construct(
        ?int      $id = null,
        ?DateTime $createdAt = null,
        ?int      $amount = null,
        ?array    $items = null
    )
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->amount = $amount;
        $this->items = $items;
    }

    public static function fromArray(array $data): self
    {
        $items = null;
        if (isset($data['items'])) {
            $items = array_map(fn($item) => HistorySpendItemResponse::fromArray($item), $data['items']);
        }

        return new self(
            $data['id'] ?? null,
            isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            $data['amount'] ?? null,
            $items
        );
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->id !== null) {
            $result['id'] = $this->id;
        }
        if ($this->createdAt !== null) {
            $result['created_at'] = $this->createdAt->format('Y-m-d H:i:s');
        }
        if ($this->amount !== null) {
            $result['amount'] = $this->amount;
        }
        if ($this->items !== null) {
            $result['items'] = array_map(fn($item) => $item->toArray(), $this->items);
        }

        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}