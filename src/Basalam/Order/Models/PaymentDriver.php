<?php

namespace Basalam\Order\Models;

/**
 * Payment driver model
 */
class PaymentDriver implements \JsonSerializable
{
    private int $amount;
    private ?string $optionCode;

    public function __construct(int $amount, ?string $optionCode = null)
    {
        $this->amount = $amount;
        $this->optionCode = $optionCode;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['amount'], $data['option_code'] ?? null);
    }

    public function toArray(): array
    {
        $result = ['amount' => $this->amount];
        if ($this->optionCode !== null) {
            $result['option_code'] = $this->optionCode;
        }
        return $result;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getOptionCode(): ?string
    {
        return $this->optionCode;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}