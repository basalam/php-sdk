<?php

namespace Basalam\Apps\Models;

/**
 * TransactionMethodDataResource model.
 */
class TransactionMethodDataResource implements \JsonSerializable
{
    private ?int $id;
    private ?int $amount;

    public function __construct(
        ?int $id,
        ?int $amount
    ) {
        $this->id = $id;
        $this->amount = $amount;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['amount'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->id !== null) {
            $result['id'] = $this->id;
        }
        if ($this->amount !== null) {
            $result['amount'] = $this->amount;
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }
}
