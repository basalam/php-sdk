<?php

namespace Basalam\Apps\Models;

use DateTime;

/**
 * PlanResource model.
 */
class PlanResource implements \JsonSerializable
{
    private ?int $id;
    private ?int $developerId;
    private ?string $name;
    private ?string $description;
    private ?int $price;
    private ?float $discountPercent;
    private ?int $effectivePrice;
    private ?EnumObjectResource $billingPeriodType;
    private ?int $billingPeriodDays;
    private ?int $trialDays;
    private ?array $features;
    private ?array $limitations;
    private ?bool $upgradeAllowed;
    private ?bool $downgradeAllowed;
    private ?EnumObjectResource $changeMode;
    private ?StatusObjectResource $status;
    private ?array $apps;
    private ?DateTime $createdAt;
    private ?DateTime $updatedAt;

    public function __construct(
        ?int $id,
        ?int $developerId,
        ?string $name,
        ?string $description,
        ?int $price,
        ?float $discountPercent,
        ?int $effectivePrice,
        ?EnumObjectResource $billingPeriodType,
        ?int $billingPeriodDays,
        ?int $trialDays,
        ?array $features,
        ?array $limitations,
        ?bool $upgradeAllowed,
        ?bool $downgradeAllowed,
        ?EnumObjectResource $changeMode,
        ?StatusObjectResource $status,
        ?array $apps,
        ?DateTime $createdAt,
        ?DateTime $updatedAt
    ) {
        $this->id = $id;
        $this->developerId = $developerId;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->discountPercent = $discountPercent;
        $this->effectivePrice = $effectivePrice;
        $this->billingPeriodType = $billingPeriodType;
        $this->billingPeriodDays = $billingPeriodDays;
        $this->trialDays = $trialDays;
        $this->features = $features;
        $this->limitations = $limitations;
        $this->upgradeAllowed = $upgradeAllowed;
        $this->downgradeAllowed = $downgradeAllowed;
        $this->changeMode = $changeMode;
        $this->status = $status;
        $this->apps = $apps;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['developer_id'] ?? null,
            $data['name'] ?? null,
            $data['description'] ?? null,
            $data['price'] ?? null,
            $data['discount_percent'] ?? null,
            $data['effective_price'] ?? null,
            isset($data['billing_period_type']) ? EnumObjectResource::fromArray($data['billing_period_type']) : null,
            $data['billing_period_days'] ?? null,
            $data['trial_days'] ?? null,
            $data['features'] ?? null,
            $data['limitations'] ?? null,
            $data['upgrade_allowed'] ?? null,
            $data['downgrade_allowed'] ?? null,
            isset($data['change_mode']) ? EnumObjectResource::fromArray($data['change_mode']) : null,
            isset($data['status']) ? StatusObjectResource::fromArray($data['status']) : null,
            isset($data['apps']) ? array_map(fn($item) => PlanAppResource::fromArray($item), $data['apps']) : null,
            isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            isset($data['updated_at']) ? new DateTime($data['updated_at']) : null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->id !== null) {
            $result['id'] = $this->id;
        }
        if ($this->developerId !== null) {
            $result['developer_id'] = $this->developerId;
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
        if ($this->billingPeriodDays !== null) {
            $result['billing_period_days'] = $this->billingPeriodDays;
        }
        if ($this->trialDays !== null) {
            $result['trial_days'] = $this->trialDays;
        }
        if ($this->features !== null) {
            $result['features'] = $this->features;
        }
        if ($this->limitations !== null) {
            $result['limitations'] = $this->limitations;
        }
        if ($this->upgradeAllowed !== null) {
            $result['upgrade_allowed'] = $this->upgradeAllowed;
        }
        if ($this->downgradeAllowed !== null) {
            $result['downgrade_allowed'] = $this->downgradeAllowed;
        }
        if ($this->changeMode !== null) {
            $result['change_mode'] = $this->changeMode->toArray();
        }
        if ($this->status !== null) {
            $result['status'] = $this->status->toArray();
        }
        if ($this->apps !== null) {
            $result['apps'] = array_map(fn($item) => $item->toArray(), $this->apps);
        }
        if ($this->createdAt !== null) {
            $result['created_at'] = $this->createdAt->format('Y-m-d H:i:s');
        }
        if ($this->updatedAt !== null) {
            $result['updated_at'] = $this->updatedAt->format('Y-m-d H:i:s');
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

    public function getDeveloperId(): ?int
    {
        return $this->developerId;
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

    public function getBillingPeriodType(): ?EnumObjectResource
    {
        return $this->billingPeriodType;
    }

    public function getBillingPeriodDays(): ?int
    {
        return $this->billingPeriodDays;
    }

    public function getTrialDays(): ?int
    {
        return $this->trialDays;
    }

    public function getFeatures(): ?array
    {
        return $this->features;
    }

    public function getLimitations(): ?array
    {
        return $this->limitations;
    }

    public function getUpgradeAllowed(): ?bool
    {
        return $this->upgradeAllowed;
    }

    public function getDowngradeAllowed(): ?bool
    {
        return $this->downgradeAllowed;
    }

    public function getChangeMode(): ?EnumObjectResource
    {
        return $this->changeMode;
    }

    public function getStatus(): ?StatusObjectResource
    {
        return $this->status;
    }

    public function getApps(): ?array
    {
        return $this->apps;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }
}
