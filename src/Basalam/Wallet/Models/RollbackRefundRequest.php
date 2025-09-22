<?php

namespace Basalam\Wallet\Models;

/**
 * Rollback refund request model.
 */
class RollbackRefundRequest
{
    private int $refundReason;
    private int $rollbackRefundReason;
    private int $refundReferenceId;
    private int $referenceId;
    private ?string $description;
    private ?array $references;

    public function __construct(
        int     $refundReason,
        int     $rollbackRefundReason,
        int     $refundReferenceId,
        int     $referenceId,
        ?string $description = null,
        ?array  $references = null
    )
    {
        $this->refundReason = $refundReason;
        $this->rollbackRefundReason = $rollbackRefundReason;
        $this->refundReferenceId = $refundReferenceId;
        $this->referenceId = $referenceId;
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
            $data['refund_reason'],
            $data['rollback_refund_reason'],
            $data['refund_reference_id'],
            $data['reference_id'],
            $data['description'] ?? null,
            $references
        );
    }

    public function toArray(): array
    {
        $result = [
            'refund_reason' => $this->refundReason,
            'rollback_refund_reason' => $this->rollbackRefundReason,
            'refund_reference_id' => $this->refundReferenceId,
            'reference_id' => $this->referenceId,
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

    public function getRefundReason(): int
    {
        return $this->refundReason;
    }

    public function getRollbackRefundReason(): int
    {
        return $this->rollbackRefundReason;
    }

    public function getRefundReferenceId(): int
    {
        return $this->refundReferenceId;
    }

    public function getReferenceId(): int
    {
        return $this->referenceId;
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