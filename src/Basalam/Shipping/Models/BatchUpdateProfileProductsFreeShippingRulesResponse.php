<?php

namespace Basalam\Shipping\Models;

/**
 * BatchUpdateProfileProductsFreeShippingRulesResponse model.
 */
class BatchUpdateProfileProductsFreeShippingRulesResponse implements \JsonSerializable
{
    private int $updatedCount;
    private array $updatedProductIds;
    private array $notFoundProductIds;
    private string $defaultRule;
    private ?array $neverFreeZoneIds;

    public function __construct(
        int $updatedCount,
        array $updatedProductIds,
        array $notFoundProductIds,
        string $defaultRule,
        ?array $neverFreeZoneIds
    ) {
        $this->updatedCount = $updatedCount;
        $this->updatedProductIds = $updatedProductIds;
        $this->notFoundProductIds = $notFoundProductIds;
        $this->defaultRule = $defaultRule;
        $this->neverFreeZoneIds = $neverFreeZoneIds;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['updated_count'],
            $data['updated_product_ids'] ?? [],
            $data['not_found_product_ids'] ?? [],
            $data['default_rule'],
            $data['never_free_zone_ids'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['updated_count'] = $this->updatedCount;
        $result['updated_product_ids'] = $this->updatedProductIds;
        $result['not_found_product_ids'] = $this->notFoundProductIds;
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

    public function getUpdatedCount(): int
    {
        return $this->updatedCount;
    }

    public function getUpdatedProductIds(): array
    {
        return $this->updatedProductIds;
    }

    public function getNotFoundProductIds(): array
    {
        return $this->notFoundProductIds;
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
