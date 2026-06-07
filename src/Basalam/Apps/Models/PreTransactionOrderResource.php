<?php

namespace Basalam\Apps\Models;

/**
 * PreTransactionOrderResource model.
 */
class PreTransactionOrderResource implements \JsonSerializable
{
    private ?int $amount;
    private ?int $customerFee;
    private ?float $customerFeePercentage;
    private ?int $merchantFee;
    private ?float $merchantFeePercentage;
    private ?int $totalFee;
    private ?int $totalAmount;

    public function __construct(
        ?int $amount,
        ?int $customerFee,
        ?float $customerFeePercentage,
        ?int $merchantFee,
        ?float $merchantFeePercentage,
        ?int $totalFee,
        ?int $totalAmount
    ) {
        $this->amount = $amount;
        $this->customerFee = $customerFee;
        $this->customerFeePercentage = $customerFeePercentage;
        $this->merchantFee = $merchantFee;
        $this->merchantFeePercentage = $merchantFeePercentage;
        $this->totalFee = $totalFee;
        $this->totalAmount = $totalAmount;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['amount'] ?? null,
            $data['customer_fee'] ?? null,
            $data['customer_fee_percentage'] ?? null,
            $data['merchant_fee'] ?? null,
            $data['merchant_fee_percentage'] ?? null,
            $data['total_fee'] ?? null,
            $data['total_amount'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->amount !== null) {
            $result['amount'] = $this->amount;
        }
        if ($this->customerFee !== null) {
            $result['customer_fee'] = $this->customerFee;
        }
        if ($this->customerFeePercentage !== null) {
            $result['customer_fee_percentage'] = $this->customerFeePercentage;
        }
        if ($this->merchantFee !== null) {
            $result['merchant_fee'] = $this->merchantFee;
        }
        if ($this->merchantFeePercentage !== null) {
            $result['merchant_fee_percentage'] = $this->merchantFeePercentage;
        }
        if ($this->totalFee !== null) {
            $result['total_fee'] = $this->totalFee;
        }
        if ($this->totalAmount !== null) {
            $result['total_amount'] = $this->totalAmount;
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function getCustomerFee(): ?int
    {
        return $this->customerFee;
    }

    public function getCustomerFeePercentage(): ?float
    {
        return $this->customerFeePercentage;
    }

    public function getMerchantFee(): ?int
    {
        return $this->merchantFee;
    }

    public function getMerchantFeePercentage(): ?float
    {
        return $this->merchantFeePercentage;
    }

    public function getTotalFee(): ?int
    {
        return $this->totalFee;
    }

    public function getTotalAmount(): ?int
    {
        return $this->totalAmount;
    }
}
