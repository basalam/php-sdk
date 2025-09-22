<?php

namespace Basalam\Wallet\Models;

use DateTime;

/**
 * Credit creation response model.
 */
class CreditCreationResponse implements \JsonSerializable
{
    private int $id;
    private int $clientId;
    private int $referenceId;
    private int $userId;
    private ?ReasonResponse $reason;
    private int $amount;
    private ?string $description;
    private ?DateTime $createdAt;
    private array $credits;
    private ?array $references;

    public function __construct(
        int             $id,
        int             $clientId,
        int             $referenceId,
        int             $userId,
        ?ReasonResponse $reason,
        int             $amount,
        ?string         $description,
        ?DateTime       $createdAt,
        array           $credits,
        ?array          $references = null
    )
    {
        $this->id = $id;
        $this->clientId = $clientId;
        $this->referenceId = $referenceId;
        $this->userId = $userId;
        $this->reason = $reason;
        $this->amount = $amount;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->credits = $credits;
        $this->references = $references;
    }

    public static function fromArray(array $data): self
    {
        $credits = array_map(fn($credit) => CreditResponse::fromArray($credit), $data['credits']);
        $references = null;
        if (isset($data['references'])) {
            $references = array_map(fn($ref) => ReferenceResponse::fromArray($ref), $data['references']);
        }

        return new self(
            $data['id'],
            $data['client_id'],
            $data['reference_id'],
            $data['user_id'],
            isset($data['reason']) ? ReasonResponse::fromArray($data['reason']) : null,
            $data['amount'],
            $data['description'] ?? null,
            isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            $credits,
            $references
        );
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->id,
            'client_id' => $this->clientId,
            'reference_id' => $this->referenceId,
            'user_id' => $this->userId,
            'amount' => $this->amount,
            'credits' => array_map(fn($credit) => $credit->toArray(), $this->credits),
        ];

        if ($this->reason !== null) {
            $result['reason'] = $this->reason->toArray();
        }
        if ($this->description !== null) {
            $result['description'] = $this->description;
        }
        if ($this->createdAt !== null) {
            $result['created_at'] = $this->createdAt->format('Y-m-d H:i:s');
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

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function getReferenceId(): int
    {
        return $this->referenceId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getReason(): ?ReasonResponse
    {
        return $this->reason;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function getCredits(): array
    {
        return $this->credits;
    }

    public function getReferences(): ?array
    {
        return $this->references;
    }
}