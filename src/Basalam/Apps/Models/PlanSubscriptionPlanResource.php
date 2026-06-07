<?php

namespace Basalam\Apps\Models;

/**
 * PlanSubscriptionPlanResource model.
 */
class PlanSubscriptionPlanResource implements \JsonSerializable
{
    private ?int $id;
    private ?string $name;
    private ?int $price;
    private ?PlanSubscriptionBillingPeriodResource $billingPeriodType;
    private ?int $trialDays;

    public function __construct(
        ?int $id,
        ?string $name,
        ?int $price,
        ?PlanSubscriptionBillingPeriodResource $billingPeriodType,
        ?int $trialDays
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->billingPeriodType = $billingPeriodType;
        $this->trialDays = $trialDays;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['name'] ?? null,
            $data['price'] ?? null,
            isset($data['billing_period_type']) ? PlanSubscriptionBillingPeriodResource::fromArray($data['billing_period_type']) : null,
            $data['trial_days'] ?? null
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
        if ($this->price !== null) {
            $result['price'] = $this->price;
        }
        if ($this->billingPeriodType !== null) {
            $result['billing_period_type'] = $this->billingPeriodType->toArray();
        }
        if ($this->trialDays !== null) {
            $result['trial_days'] = $this->trialDays;
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function getBillingPeriodType(): ?PlanSubscriptionBillingPeriodResource
    {
        return $this->billingPeriodType;
    }

    public function getTrialDays(): ?int
    {
        return $this->trialDays;
    }
}
