<?php

namespace Basalam\Wallet\Models;

/**
 * History spend item response model.
 */
class HistorySpendItemResponse implements \JsonSerializable
{
    private int $id;
    private int $amount;

    public function __construct(int $id, int $amount)
    {
        $this->id = $id;
        $this->amount = $amount;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['id'], $data['amount']);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}