<?php

namespace Basalam\Wallet\Models;

use DateTime;

/**
 * History credit item response model.
 */
class HistoryCreditItemResponse implements \JsonSerializable
{
    private int $id;
    private int $amount;
    private int $remainedAmount;
    private DateTime $createdAt;
    private ?DateTime $expireAt;
    private CreditTypeResponse $type;

    public function __construct(
        int                $id,
        int                $amount,
        int                $remainedAmount,
        DateTime           $createdAt,
        ?DateTime          $expireAt,
        CreditTypeResponse $type
    )
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->remainedAmount = $remainedAmount;
        $this->createdAt = $createdAt;
        $this->expireAt = $expireAt;
        $this->type = $type;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['amount'],
            $data['remained_amount'],
            new DateTime($data['created_at']),
            isset($data['expire_at']) ? new DateTime($data['expire_at']) : null,
            CreditTypeResponse::fromArray($data['type'])
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'remained_amount' => $this->remainedAmount,
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            'expire_at' => $this->expireAt?->format('Y-m-d H:i:s'),
            'type' => $this->type->toArray(),
        ];
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

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getRemainedAmount(): int
    {
        return $this->remainedAmount;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getExpireAt(): ?DateTime
    {
        return $this->expireAt;
    }

    public function getType(): CreditTypeResponse
    {
        return $this->type;
    }
}

