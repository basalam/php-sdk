<?php

namespace Basalam\Wallet\Models;

use DateTime;

/**
 * New history credit response model.
 */
class NewHistoryCreditResponse implements \JsonSerializable
{
    private ?int $amount;
    private ?int $remainedAmount;
    private ?DateTime $createdAt;
    private ?array $items;

    public function __construct(
        ?int      $amount = null,
        ?int      $remainedAmount = null,
        ?DateTime $createdAt = null,
        ?array    $items = null
    )
    {
        $this->amount = $amount;
        $this->remainedAmount = $remainedAmount;
        $this->createdAt = $createdAt;
        $this->items = $items;
    }

    public static function fromArray(array $data): self
    {
        $items = null;
        if (isset($data['items'])) {
            $items = array_map(fn($item) => HistoryCreditItemResponse::fromArray($item), $data['items']);
        }

        return new self(
            $data['amount'] ?? null,
            $data['remained_amount'] ?? null,
            isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            $items
        );
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->amount !== null) {
            $result['amount'] = $this->amount;
        }
        if ($this->remainedAmount !== null) {
            $result['remained_amount'] = $this->remainedAmount;
        }
        if ($this->createdAt !== null) {
            $result['created_at'] = $this->createdAt->format('Y-m-d H:i:s');
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

    // Getters
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function getRemainedAmount(): ?int
    {
        return $this->remainedAmount;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function getItems(): ?array
    {
        return $this->items;
    }
}