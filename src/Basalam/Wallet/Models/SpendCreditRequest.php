<?php

namespace Basalam\Wallet\Models;

/**
 * Spend credit request model.
 */
class SpendCreditRequest
{
    private int $reasonId;
    private int $referenceId;
    private int $amount;
    private string $description;
    private ?array $types;
    private ?bool $settleable;
    private ?array $references;

    public function __construct(
        int    $reasonId,
        int    $referenceId,
        int    $amount,
        string $description,
        ?array $types = null,
        ?bool  $settleable = null,
        ?array $references = null
    )
    {
        $this->reasonId = $reasonId;
        $this->referenceId = $referenceId;
        $this->amount = $amount;
        $this->description = $description;
        $this->types = $types;
        $this->settleable = $settleable;
        $this->references = $references;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['reason_id'],
            $data['reference_id'],
            $data['amount'],
            $data['description'],
            $data['types'] ?? null,
            $data['settleable'] ?? null,
            $data['references'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [
            'reason_id' => $this->reasonId,
            'reference_id' => $this->referenceId,
            'amount' => $this->amount,
            'description' => $this->description,
        ];

        if ($this->types !== null) {
            $result['types'] = $this->types;
        }
        if ($this->settleable !== null) {
            $result['settleable'] = $this->settleable;
        }
        if ($this->references !== null) {
            $result['references'] = $this->references;
        }

        return $result;
    }

    // Getters

    public function getReasonId(): int
    {
        return $this->reasonId;
    }

    public function getReferenceId(): int
    {
        return $this->referenceId;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getTypes(): ?array
    {
        return $this->types;
    }

    public function getSettleable(): ?bool
    {
        return $this->settleable;
    }

    public function getReferences(): ?array
    {
        return $this->references;
    }
}