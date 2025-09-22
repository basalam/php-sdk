<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Amount drivers model.
 */
class AmountDrivers implements JsonSerializable
{
    private int $gateway;
    private int $credit;
    private int $salampay;
    private int $other;
    private int $total;
    private array $otherDriversDetail;

    public function __construct(
        int   $gateway,
        int   $credit,
        int   $salampay,
        int   $other,
        int   $total,
        array $otherDriversDetail
    )
    {
        $this->gateway = $gateway;
        $this->credit = $credit;
        $this->salampay = $salampay;
        $this->other = $other;
        $this->total = $total;
        $this->otherDriversDetail = $otherDriversDetail;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['gateway'],
            $data['credit'],
            $data['salampay'],
            $data['other'],
            $data['total'],
            $data['other_drivers_detail']
        );
    }

    public function toArray(): array
    {
        return [
            'gateway' => $this->gateway,
            'credit' => $this->credit,
            'salampay' => $this->salampay,
            'other' => $this->other,
            'total' => $this->total,
            'other_drivers_detail' => $this->otherDriversDetail,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}