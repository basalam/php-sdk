<?php

namespace Basalam\Wallet\Models;

/**
 * Refund request model.
 */
class RefundRequest
{
    private int $originalReason;
    private int $originalReferenceId;
    private int $reason;
    private int $referenceId;
    private int $amount;
    private ?string $description;
    private ?array $references;

    public function __construct(
        int     $originalReason,
        int     $originalReferenceId,
        int     $reason,
        int     $referenceId,
        int     $amount,
        ?string $description = null,
        ?array  $references = null
    )
    {
        $this->originalReason = $originalReason;
        $this->originalReferenceId = $originalReferenceId;
        $this->reason = $reason;
        $this->referenceId = $referenceId;
        $this->amount = $amount;
        $this->description = $description;
        $this->references = $references;
    }

    public static function fromArray(array $data): self
    {
        $references = null;
        if (isset($data['references'])) {
            $references = array_map(fn($ref) => ReferenceRequest::fromArray($ref), $data['references']);
        }

        return new self(
            $data['original_reason'],
            $data['original_reference_id'],
            $data['reason'],
            $data['reference_id'],
            $data['amount'],
            $data['description'] ?? null,
            $references
        );
    }

    public function toArray(): array
    {
        $result = [
            'original_reason' => $this->originalReason,
            'original_reference_id' => $this->originalReferenceId,
            'reason' => $this->reason,
            'reference_id' => $this->referenceId,
            'amount' => $this->amount,
        ];

        if ($this->description !== null) {
            $result['description'] = $this->description;
        }
        if ($this->references !== null) {
            $result['references'] = array_map(fn($ref) => $ref->toArray(), $this->references);
        }

        return $result;
    }

    // Getters

    public function getOriginalReason(): int
    {
        return $this->originalReason;
    }

    public function getOriginalReferenceId(): int
    {
        return $this->originalReferenceId;
    }

    public function getReason(): int
    {
        return $this->reason;
    }

    public function getReferenceId(): int
    {
        return $this->referenceId;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getReferences(): ?array
    {
        return $this->references;
    }
}