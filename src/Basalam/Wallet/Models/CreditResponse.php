<?php

namespace Basalam\Wallet\Models;

use DateTime;

/**
 * Credit response model.
 */
class CreditResponse implements \JsonSerializable
{
    private int $id;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private ?DateTime $expireAt;
    private int $userId;
    private ?int $clientId;
    private ?int $referenceId;
    private ?ReasonResponse $reason;
    private int $amount;
    private int $remainedAmount;
    private ?string $description;
    private CreditTypeResponse $type;
    private ?array $references;

    public function __construct(
        int                $id,
        DateTime           $createdAt,
        DateTime           $updatedAt,
        ?DateTime          $expireAt,
        int                $userId,
        ?int               $clientId,
        ?int               $referenceId,
        ?ReasonResponse    $reason,
        int                $amount,
        int                $remainedAmount,
        ?string            $description,
        CreditTypeResponse $type,
        ?array             $references = null
    )
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->expireAt = $expireAt;
        $this->userId = $userId;
        $this->clientId = $clientId;
        $this->referenceId = $referenceId;
        $this->reason = $reason;
        $this->amount = $amount;
        $this->remainedAmount = $remainedAmount;
        $this->description = $description;
        $this->type = $type;
        $this->references = $references;
    }

    public static function fromArray(array $data): self
    {
        $references = null;
        if (isset($data['references'])) {
            $references = array_map(fn($ref) => ReferenceResponse::fromArray($ref), $data['references']);
        }

        return new self(
            $data['id'],
            new DateTime($data['created_at']),
            new DateTime($data['updated_at']),
            isset($data['expire_at']) ? new DateTime($data['expire_at']) : null,
            $data['user_id'],
            $data['client_id'] ?? null,
            $data['reference_id'] ?? null,
            isset($data['reason']) ? ReasonResponse::fromArray($data['reason']) : null,
            $data['amount'],
            $data['remained_amount'],
            $data['description'] ?? null,
            CreditTypeResponse::fromArray($data['type']),
            $references
        );
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->id,
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt->format('Y-m-d H:i:s'),
            'user_id' => $this->userId,
            'amount' => $this->amount,
            'remained_amount' => $this->remainedAmount,
            'type' => $this->type->toArray(),
        ];

        if ($this->expireAt !== null) {
            $result['expire_at'] = $this->expireAt->format('Y-m-d H:i:s');
        }
        if ($this->clientId !== null) {
            $result['client_id'] = $this->clientId;
        }
        if ($this->referenceId !== null) {
            $result['reference_id'] = $this->referenceId;
        }
        if ($this->reason !== null) {
            $result['reason'] = $this->reason->toArray();
        }
        if ($this->description !== null) {
            $result['description'] = $this->description;
        }
        if ($this->references !== null) {
            $result['references'] = array_map(fn($ref) => $ref->toArray(), $this->references);
        }

        return $result;
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

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function getExpireAt(): ?DateTime
    {
        return $this->expireAt;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    public function getReferenceId(): ?int
    {
        return $this->referenceId;
    }

    public function getReason(): ?ReasonResponse
    {
        return $this->reason;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getRemainedAmount(): int
    {
        return $this->remainedAmount;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getType(): CreditTypeResponse
    {
        return $this->type;
    }

    public function getReferences(): ?array
    {
        return $this->references;
    }
}