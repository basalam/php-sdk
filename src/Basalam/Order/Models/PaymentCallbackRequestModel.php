<?php

namespace Basalam\Order\Models;

/**
 * Payment callback request model
 */
class PaymentCallbackRequestModel implements \JsonSerializable
{
    private string $status;
    private ?string $transactionId;
    private ?string $description;

    public function __construct(
        string  $status,
        ?string $transactionId = null,
        ?string $description = null
    )
    {
        $this->status = $status;
        $this->transactionId = $transactionId;
        $this->description = $description;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['status'],
            $data['transaction_id'] ?? null,
            $data['description'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = ['status' => $this->status];

        if ($this->transactionId !== null) {
            $result['transaction_id'] = $this->transactionId;
        }

        if ($this->description !== null) {
            $result['description'] = $this->description;
        }

        return $result;
    }

    // Getters

    public function getStatus(): string
    {
        return $this->status;
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