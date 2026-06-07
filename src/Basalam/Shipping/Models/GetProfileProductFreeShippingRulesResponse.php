<?php

namespace Basalam\Shipping\Models;

/**
 * GetProfileProductFreeShippingRulesResponse model.
 */
class GetProfileProductFreeShippingRulesResponse implements \JsonSerializable
{
    private int $profileId;
    private int $productId;
    private string $defaultRule;
    private ?array $neverFreeZoneIds;

    public function __construct(
        int $profileId,
        int $productId,
        string $defaultRule,
        ?array $neverFreeZoneIds
    ) {
        $this->profileId = $profileId;
        $this->productId = $productId;
        $this->defaultRule = $defaultRule;
        $this->neverFreeZoneIds = $neverFreeZoneIds;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['profile_id'],
            $data['product_id'],
            $data['default_rule'],
            $data['never_free_zone_ids'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['profile_id'] = $this->profileId;
        $result['product_id'] = $this->productId;
        $result['default_rule'] = $this->defaultRule;
        if ($this->neverFreeZoneIds !== null) {
            $result['never_free_zone_ids'] = $this->neverFreeZoneIds;
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getProfileId(): int
    {
        return $this->profileId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getDefaultRule(): string
    {
        return $this->defaultRule;
    }

    public function getNeverFreeZoneIds(): ?array
    {
        return $this->neverFreeZoneIds;
    }
}
