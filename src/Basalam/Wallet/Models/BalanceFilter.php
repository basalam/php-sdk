<?php

namespace Basalam\Wallet\Models;

/**
 * Filter for balance requests.
 */
class BalanceFilter
{
    private ?bool $cash;
    private ?bool $settleable;
    private ?bool $vendor;
    private ?bool $customer;

    public function __construct(
        ?bool $cash = null,
        ?bool $settleable = null,
        ?bool $vendor = null,
        ?bool $customer = null
    )
    {
        $this->cash = $cash;
        $this->settleable = $settleable;
        $this->vendor = $vendor;
        $this->customer = $customer;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['cash'] ?? null,
            $data['settleable'] ?? null,
            $data['vendor'] ?? null,
            $data['customer'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->cash !== null) {
            $result['cash'] = $this->cash;
        }
        if ($this->settleable !== null) {
            $result['settleable'] = $this->settleable;
        }
        if ($this->vendor !== null) {
            $result['vendor'] = $this->vendor;
        }
        if ($this->customer !== null) {
            $result['customer'] = $this->customer;
        }

        return $result;
    }

    // Getters

    public function getCash(): ?bool
    {
        return $this->cash;
    }

    public function setCash(?bool $cash): self
    {
        $this->cash = $cash;
        return $this;
    }

    public function getSettleable(): ?bool
    {
        return $this->settleable;
    }

    public function setSettleable(?bool $settleable): self
    {
        $this->settleable = $settleable;
        return $this;
    }

    // Setters

    public function getVendor(): ?bool
    {
        return $this->vendor;
    }

    public function setVendor(?bool $vendor): self
    {
        $this->vendor = $vendor;
        return $this;
    }

    public function getCustomer(): ?bool
    {
        return $this->customer;
    }

    public function setCustomer(?bool $customer): self
    {
        $this->customer = $customer;
        return $this;
    }
}