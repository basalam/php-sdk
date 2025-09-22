<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Order model.
 */
class Order implements JsonSerializable
{
    private int $id;
    private AmountDrivers $amountDrivers;
    private int $amount;
    private bool $hasCredit;
    private int $bnplAmount;
    private int $installmentAmount;
    private int $couponDiscount;
    private int $creditAmount;
    private string $paidAt;
    private ?string $couponCode;
    private string $createdAt;
    private Customer $customer;
    private array $parcels;

    public function __construct(
        int           $id,
        AmountDrivers $amountDrivers,
        int           $amount,
        bool          $hasCredit,
        int           $bnplAmount,
        int           $installmentAmount,
        int           $couponDiscount,
        int           $creditAmount,
        string        $paidAt,
        string        $createdAt,
        Customer      $customer,
        array         $parcels,
        ?string       $couponCode = null
    )
    {
        $this->id = $id;
        $this->amountDrivers = $amountDrivers;
        $this->amount = $amount;
        $this->hasCredit = $hasCredit;
        $this->bnplAmount = $bnplAmount;
        $this->installmentAmount = $installmentAmount;
        $this->couponDiscount = $couponDiscount;
        $this->creditAmount = $creditAmount;
        $this->paidAt = $paidAt;
        $this->createdAt = $createdAt;
        $this->customer = $customer;
        $this->parcels = $parcels;
        $this->couponCode = $couponCode;
    }

    public static function fromArray(array $data): self
    {
        $parcels = array_map(fn($parcel) => Parcel::fromArray($parcel), $data['parcels']);

        return new self(
            $data['id'],
            AmountDrivers::fromArray($data['amount_drivers']),
            $data['amount'],
            $data['has_credit'],
            $data['bnpl_amount'],
            $data['installment_amount'],
            $data['coupon_discount'],
            $data['credit_amount'],
            $data['paid_at'],
            $data['created_at'],
            Customer::fromArray($data['customer']),
            $parcels,
            $data['coupon_code'] ?? null
        );
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getAmountDrivers(): AmountDrivers
    {
        return $this->amountDrivers;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getHasCredit(): bool
    {
        return $this->hasCredit;
    }

    public function getBnplAmount(): int
    {
        return $this->bnplAmount;
    }

    public function getInstallmentAmount(): int
    {
        return $this->installmentAmount;
    }

    public function getCouponDiscount(): int
    {
        return $this->couponDiscount;
    }

    public function getCreditAmount(): int
    {
        return $this->creditAmount;
    }

    public function getPaidAt(): string
    {
        return $this->paidAt;
    }

    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function getParcels(): array
    {
        return $this->parcels;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'amount_drivers' => $this->amountDrivers->toArray(),
            'amount' => $this->amount,
            'has_credit' => $this->hasCredit,
            'bnpl_amount' => $this->bnplAmount,
            'installment_amount' => $this->installmentAmount,
            'coupon_discount' => $this->couponDiscount,
            'credit_amount' => $this->creditAmount,
            'paid_at' => $this->paidAt,
            'coupon_code' => $this->couponCode,
            'created_at' => $this->createdAt,
            'customer' => $this->customer->toArray(),
            'parcels' => array_map(fn($parcel) => $parcel->toArray(), $this->parcels),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}

