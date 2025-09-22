<?php

namespace Basalam\Wallet\Models;

use DateTime;

/**
 * Spend response model.
 */
class SpendResponse implements \JsonSerializable
{
    private ?int $id;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private ?DateTime $deletedAt;
    private int $amount;
    private ?string $description;
    private int $userId;
    private ?int $clientId;
    private int $referenceId;
    private ReasonResponse $reason;
    private ReasonResponse $rollbackReason;
    private array $items;
    private array $references;

    public function __construct(
        ?int           $id,
        DateTime       $createdAt,
        DateTime       $updatedAt,
        ?DateTime      $deletedAt,
        int            $amount,
        ?string        $description,
        int            $userId,
        ?int           $clientId,
        int            $referenceId,
        ReasonResponse $reason,
        ReasonResponse $rollbackReason,
        array          $items,
        array          $references
    )
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
        $this->amount = $amount;
        $this->description = $description;
        $this->userId = $userId;
        $this->clientId = $clientId;
        $this->referenceId = $referenceId;
        $this->reason = $reason;
        $this->rollbackReason = $rollbackReason;
        $this->items = $items;
        $this->references = $references;
    }

    public static function fromArray(array $data): self
    {
        $items = array_map(fn($item) => SpendItemResponse::fromArray($item), $data['items']);
        $references = array_map(fn($ref) => ReferenceResponse::fromArray($ref), $data['references']);

        return new self(
            $data['id'] ?? null,
            new DateTime($data['created_at']),
            new DateTime($data['updated_at']),
            isset($data['deleted_at']) ? new DateTime($data['deleted_at']) : null,
            $data['amount'],
            $data['description'] ?? null,
            $data['user_id'],
            $data['client_id'] ?? null,
            $data['reference_id'],
            ReasonResponse::fromArray($data['reason']),
            ReasonResponse::fromArray($data['rollback_reason']),
            $items,
            $references
        );
    }

    public function toArray(): array
    {
        $result = [
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt->format('Y-m-d H:i:s'),
            'amount' => $this->amount,
            'user_id' => $this->userId,
            'reference_id' => $this->referenceId,
            'reason' => $this->reason->toArray(),
            'rollback_reason' => $this->rollbackReason->toArray(),
            'items' => array_map(fn($item) => $item->toArray(), $this->items),
            'references' => array_map(fn($ref) => $ref->toArray(), $this->references),
        ];

        if ($this->id !== null) {
            $result['id'] = $this->id;
        }
        if ($this->deletedAt !== null) {
            $result['deleted_at'] = $this->deletedAt->format('Y-m-d H:i:s');
        }
        if ($this->description !== null) {
            $result['description'] = $this->description;
        }
        if ($this->clientId !== null) {
            $result['client_id'] = $this->clientId;
        }

        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    // Getters

    public function getId(): ?int
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

    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getClientId(): ?int
    {
        return $this->clientId;
    }

    public function getReferenceId(): int
    {
        return $this->referenceId;
    }

    public function getReason(): ReasonResponse
    {
        return $this->reason;
    }

    public function getRollbackReason(): ReasonResponse
    {
        return $this->rollbackReason;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getReferences(): array
    {
        return $this->references;
    }
}