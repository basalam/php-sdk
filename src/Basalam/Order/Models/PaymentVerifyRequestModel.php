<?php

namespace Basalam\Order\Models;

/**
 * Payment verify request model
 */
class PaymentVerifyRequestModel implements \JsonSerializable
{
    private string $paymentId;
    private ?string $transactionId;
    private ?string $description;

    public function __construct(
        string  $paymentId,
        ?string $transactionId = null,
        ?string $description = null
    )
    {
        $this->paymentId = $paymentId;
        $this->transactionId = $transactionId;
        $this->description = $description;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['payment_id'],
            $data['transaction_id'] ?? null,
            $data['description'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = ['payment_id' => $this->paymentId];

        if ($this->transactionId !== null) {
            $result['transaction_id'] = $this->transactionId;
        }

        if ($this->description !== null) {
            $result['description'] = $this->description;
        }

        return $result;
    }

    // Getters

    public function getPaymentId(): string
    {
        return $this->paymentId;
    }

    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}