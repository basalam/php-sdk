<?php

namespace Basalam\Order\Models;

/**
 * Total cost breakdown model
 */
class TotalCostBreakdown implements \JsonSerializable
{
    private ?int $base;
    private ?int $discount;
    private ?int $credit;
    private ?int $bnpl;
    private ?int $installment;
    private ?int $payLines;
    private ?int $grand;

    public function __construct(
        ?int $base = null,
        ?int $discount = null,
        ?int $credit = null,
        ?int $bnpl = null,
        ?int $installment = null,
        ?int $payLines = null,
        ?int $grand = null
    )
    {
        $this->base = $base;
        $this->discount = $discount;
        $this->credit = $credit;
        $this->bnpl = $bnpl;
        $this->installment = $installment;
        $this->payLines = $payLines;
        $this->grand = $grand;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['base'] ?? null,
            $data['discount'] ?? null,
            $data['credit'] ?? null,
            $data['bnpl'] ?? null,
            $data['installment'] ?? null,
            $data['pay_lines'] ?? null,
            $data['grand'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->base !== null) $result['base'] = $this->base;
        if ($this->discount !== null) $result['discount'] = $this->discount;
        if ($this->credit !== null) $result['credit'] = $this->credit;
        if ($this->bnpl !== null) $result['bnpl'] = $this->bnpl;
        if ($this->installment !== null) $result['installment'] = $this->installment;
        if ($this->payLines !== null) $result['pay_lines'] = $this->payLines;
        if ($this->grand !== null) $result['grand'] = $this->grand;

        return $result;
    }

    // Getters

    public function getBase(): ?int
    {
        return $this->base;
    }

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function getCredit(): ?int
    {
        return $this->credit;
    }

    public function getBnpl(): ?int
    {
        return $this->bnpl;
    }

    public function getInstallment(): ?int
    {
        return $this->installment;
    }

    public function getPayLines(): ?int
    {
        return $this->payLines;
    }

    public function getGrand(): ?int
    {
        return $this->grand;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}