<?php

namespace Basalam\Wallet\Models;

/**
 * Spend item response model.
 */
class SpendItemResponse implements \JsonSerializable
{
    private int $id;
    private int $amount;
    private array $references;
    private CreditResponse $credit;

    public function __construct(
        int            $id,
        int            $amount,
        array          $references,
        CreditResponse $credit
    )
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->references = $references;
        $this->credit = $credit;
    }

    public static function fromArray(array $data): self
    {
        $references = array_map(fn($ref) => ReferenceResponse::fromArray($ref), $data['references']);

        return new self(
            $data['id'],
            $data['amount'],
            $references,
            CreditResponse::fromArray($data['credit'])
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'references' => array_map(fn($ref) => $ref->toArray(), $this->references),
            'credit' => $this->credit->toArray(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getReferences(): array
    {
        return $this->references;
    }

    public function getCredit(): CreditResponse
    {
        return $this->credit;
    }
}