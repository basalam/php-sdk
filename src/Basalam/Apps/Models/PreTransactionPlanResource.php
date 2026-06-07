<?php

namespace Basalam\Apps\Models;

/**
 * PreTransactionPlanResource model.
 */
class PreTransactionPlanResource implements \JsonSerializable
{
    private ?int $id;
    private ?string $name;
    private ?string $description;
    private ?int $price;
    private ?float $discountPercent;
    private ?int $effectivePrice;
    private ?PreTransactionPlanBillingPeriodResource $billingPeriodType;
    private ?int $trialDays;
    private ?bool $autoRenew;

    public function __construct(
        ?int $id,
        ?string $name,
        ?string $description,
        ?int $price,
        ?float $discountPercent,
        ?int $effectivePrice,
        ?PreTransactionPlanBillingPeriodResource $billingPeriodType,
        ?int $trialDays,
        ?bool $autoRenew
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->discountPercent = $discountPercent;
        $this->effectivePrice = $effectivePrice;
        $this->billingPeriodType = $billingPeriodType;
        $this->trialDays = $trialDays;
        $this->autoRenew = $autoRenew;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['name'] ?? null,
            $data['description'] ?? null,
            $data['price'] ?? null,
            $data['discount_percent'] ?? null,
            $data['effective_price'] ?? null,
            isset($data['billing_period_type']) ? PreTransactionPlanBillingPeriodResource::fromArray($data['billing_period_type']) : null,
            $data['trial_days'] ?? null,
            $data['auto_renew'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->id !== null) {
            $result['id'] = $this->id;
        }
        if ($this->name !== null) {
            $result['name'] = $this->name;
        }
        if ($this->description !== null) {
            $result['description'] = $this->description;
        }
        if ($this->price !== null) {
            $result['price'] = $this->price;
        }
        if ($this->discountPercent !== null) {
            $result['discount_percent'] = $this->discountPercent;
        }
        if ($this->effectivePrice !== null) {
            $result['effective_price'] = $this->effectivePrice;
        }
        if ($this->billingPeriodType !== null) {
            $result['billing_period_type'] = $this->billingPeriodType->toArray();
        }
        if ($this->trialDays !== null) {
            $result['trial_days'] = $this->trialDays;
        }
        if ($this->autoRenew !== null) {
            $result['auto_renew'] = $this->autoRenew;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function getDiscountPercent(): ?float
    {
        return $this->discountPercent;
    }

    public function getEffectivePrice(): ?int
    {
        return $this->effectivePrice;
    }

    public function getBillingPeriodType(): ?PreTransactionPlanBillingPeriodResource
    {
        return $this->billingPeriodType;
    }

    public function getTrialDays(): ?int
    {
        return $this->trialDays;
    }

    public function getAutoRenew(): ?bool
    {
        return $this->autoRenew;
    }
}
