<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Parcel order model.
 */
class ParcelOrder implements JsonSerializable
{
    private int $id;
    private string $paidAt;
    private string $createdAt;
    private Customer $customer;

    public function __construct(
        int      $id,
        string   $paidAt,
        string   $createdAt,
        Customer $customer
    )
    {
        $this->id = $id;
        $this->paidAt = $paidAt;
        $this->createdAt = $createdAt;
        $this->customer = $customer;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['paid_at'],
            $data['created_at'],
            Customer::fromArray($data['customer'])
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'paid_at' => $this->paidAt,
            'created_at' => $this->createdAt,
            'customer' => $this->customer->toArray(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}