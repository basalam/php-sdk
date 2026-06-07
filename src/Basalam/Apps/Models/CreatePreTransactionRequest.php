<?php

namespace Basalam\Apps\Models;

/**
 * CreatePreTransactionRequest model.
 */
class CreatePreTransactionRequest implements \JsonSerializable
{
    private string $referenceId;
    private int $amount;
    private ?string $description;
    private string $callbackUrl;
    private ?int $planId;
    private ?int $userId;

    public function __construct(
        string $referenceId,
        int $amount,
        ?string $description,
        string $callbackUrl,
        ?int $planId,
        ?int $userId
    ) {
        $this->referenceId = $referenceId;
        $this->amount = $amount;
        $this->description = $description;
        $this->callbackUrl = $callbackUrl;
        $this->planId = $planId;
        $this->userId = $userId;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['reference_id'],
            $data['amount'],
            $data['description'] ?? null,
            $data['callback_url'],
            $data['plan_id'] ?? null,
            $data['user_id'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['reference_id'] = $this->referenceId;
        $result['amount'] = $this->amount;
        if ($this->description !== null) {
            $result['description'] = $this->description;
        }
        $result['callback_url'] = $this->callbackUrl;
        if ($this->planId !== null) {
            $result['plan_id'] = $this->planId;
        }
        if ($this->userId !== null) {
            $result['user_id'] = $this->userId;
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getReferenceId(): string
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

    public function getCallbackUrl(): string
    {
        return $this->callbackUrl;
    }

    public function getPlanId(): ?int
    {
        return $this->planId;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }
}
