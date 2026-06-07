<?php

namespace Basalam\Apps\Models;

/**
 * PlanSubscriptionResource model.
 */
class PlanSubscriptionResource implements \JsonSerializable
{
    private ?int $id;
    private ?PlanSubscriptionPlanResource $plan;
    private ?PlanSubscriptionCustomerResource $customer;
    private ?PlanSubscriptionAppResource $app;
    private ?PlanSubscriptionStatusResource $status;
    private ?bool $autoRenew;
    private mixed $currentPeriodStart;
    private mixed $currentPeriodEnd;
    private mixed $trialEnd;
    private mixed $gracePeriodEnd;
    private mixed $cancelledAt;
    private mixed $createdAt;
    private mixed $updatedAt;

    public function __construct(
        ?int $id,
        ?PlanSubscriptionPlanResource $plan,
        ?PlanSubscriptionCustomerResource $customer,
        ?PlanSubscriptionAppResource $app,
        ?PlanSubscriptionStatusResource $status,
        ?bool $autoRenew,
        mixed $currentPeriodStart,
        mixed $currentPeriodEnd,
        mixed $trialEnd,
        mixed $gracePeriodEnd,
        mixed $cancelledAt,
        mixed $createdAt,
        mixed $updatedAt
    ) {
        $this->id = $id;
        $this->plan = $plan;
        $this->customer = $customer;
        $this->app = $app;
        $this->status = $status;
        $this->autoRenew = $autoRenew;
        $this->currentPeriodStart = $currentPeriodStart;
        $this->currentPeriodEnd = $currentPeriodEnd;
        $this->trialEnd = $trialEnd;
        $this->gracePeriodEnd = $gracePeriodEnd;
        $this->cancelledAt = $cancelledAt;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            isset($data['plan']) ? PlanSubscriptionPlanResource::fromArray($data['plan']) : null,
            isset($data['customer']) ? PlanSubscriptionCustomerResource::fromArray($data['customer']) : null,
            isset($data['app']) ? PlanSubscriptionAppResource::fromArray($data['app']) : null,
            isset($data['status']) ? PlanSubscriptionStatusResource::fromArray($data['status']) : null,
            $data['auto_renew'] ?? null,
            $data['current_period_start'] ?? null,
            $data['current_period_end'] ?? null,
            $data['trial_end'] ?? null,
            $data['grace_period_end'] ?? null,
            $data['cancelled_at'] ?? null,
            $data['created_at'] ?? null,
            $data['updated_at'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->id !== null) {
            $result['id'] = $this->id;
        }
        if ($this->plan !== null) {
            $result['plan'] = $this->plan->toArray();
        }
        if ($this->customer !== null) {
            $result['customer'] = $this->customer->toArray();
        }
        if ($this->app !== null) {
            $result['app'] = $this->app->toArray();
        }
        if ($this->status !== null) {
            $result['status'] = $this->status->toArray();
        }
        if ($this->autoRenew !== null) {
            $result['auto_renew'] = $this->autoRenew;
        }
        if ($this->currentPeriodStart !== null) {
            $result['current_period_start'] = $this->currentPeriodStart;
        }
        if ($this->currentPeriodEnd !== null) {
            $result['current_period_end'] = $this->currentPeriodEnd;
        }
        if ($this->trialEnd !== null) {
            $result['trial_end'] = $this->trialEnd;
        }
        if ($this->gracePeriodEnd !== null) {
            $result['grace_period_end'] = $this->gracePeriodEnd;
        }
        if ($this->cancelledAt !== null) {
            $result['cancelled_at'] = $this->cancelledAt;
        }
        if ($this->createdAt !== null) {
            $result['created_at'] = $this->createdAt;
        }
        if ($this->updatedAt !== null) {
            $result['updated_at'] = $this->updatedAt;
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

    public function getPlan(): ?PlanSubscriptionPlanResource
    {
        return $this->plan;
    }

    public function getCustomer(): ?PlanSubscriptionCustomerResource
    {
        return $this->customer;
    }

    public function getApp(): ?PlanSubscriptionAppResource
    {
        return $this->app;
    }

    public function getStatus(): ?PlanSubscriptionStatusResource
    {
        return $this->status;
    }

    public function getAutoRenew(): ?bool
    {
        return $this->autoRenew;
    }

    public function getCurrentPeriodStart(): mixed
    {
        return $this->currentPeriodStart;
    }

    public function getCurrentPeriodEnd(): mixed
    {
        return $this->currentPeriodEnd;
    }

    public function getTrialEnd(): mixed
    {
        return $this->trialEnd;
    }

    public function getGracePeriodEnd(): mixed
    {
        return $this->gracePeriodEnd;
    }

    public function getCancelledAt(): mixed
    {
        return $this->cancelledAt;
    }

    public function getCreatedAt(): mixed
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): mixed
    {
        return $this->updatedAt;
    }
}
