<?php

namespace Basalam\Order\Models;

/**
 * Payment driver model
 */
class PaymentDriver implements \JsonSerializable
{
    private int $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['amount']);
    }

    public function toArray(): array
    {
        return ['amount' => $this->amount];
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}