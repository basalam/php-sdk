<?php

namespace Basalam\Wallet\Models;

/**
 * Reference request model.
 */
class ReferenceRequest
{
    private int $referenceTypeId;
    private int $referenceId;

    public function __construct(int $referenceTypeId, int $referenceId)
    {
        $this->referenceTypeId = $referenceTypeId;
        $this->referenceId = $referenceId;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['reference_type_id'],
            $data['reference_id']
        );
    }

    public function toArray(): array
    {
        return [
            'reference_type_id' => $this->referenceTypeId,
            'reference_id' => $this->referenceId,
        ];
    }

    public function getReferenceTypeId(): int
    {
        return $this->referenceTypeId;
    }

    public function getReferenceId(): int
    {
        return $this->referenceId;
    }
}