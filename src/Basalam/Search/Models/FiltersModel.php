<?php

namespace Basalam\Search\Models;

/**
 * Filters model for product search
 *
 * Note: Uses camelCase field names to match the API requirements
 */
class FiltersModel
{
    private ?int $freeShipping;
    private ?string $slug;
    private ?string $vendorIdentifier;
    private ?int $maxPrice;
    private ?int $minPrice;
    private ?int $sameCity;
    private ?int $minRating;
    private ?int $vendorScore;

    public function __construct(
        ?int    $freeShipping = null,
        ?string $slug = null,
        ?string $vendorIdentifier = null,
        ?int    $maxPrice = null,
        ?int    $minPrice = null,
        ?int    $sameCity = null,
        ?int    $minRating = null,
        ?int    $vendorScore = null
    )
    {
        $this->freeShipping = $freeShipping;
        $this->slug = $slug;
        $this->vendorIdentifier = $vendorIdentifier;
        $this->maxPrice = $maxPrice;
        $this->minPrice = $minPrice;
        $this->sameCity = $sameCity;
        $this->minRating = $minRating;
        $this->vendorScore = $vendorScore;
    }

    /**
     * Create from array
     * Note: Expects camelCase keys from API response
     *
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['freeShipping'] ?? null,
            $data['slug'] ?? null,
            $data['vendorIdentifier'] ?? null,
            $data['maxPrice'] ?? null,
            $data['minPrice'] ?? null,
            $data['sameCity'] ?? null,
            $data['minRating'] ?? null,
            $data['vendorScore'] ?? null
        );
    }

    /**
     * Convert to array for API request
     * Note: Uses camelCase keys to match the API
     *
     * @return array
     */
    public function toArray(): array
    {
        $result = [];

        if ($this->freeShipping !== null) {
            $result['freeShipping'] = $this->freeShipping;
        }
        if ($this->slug !== null) {
            $result['slug'] = $this->slug;
        }
        if ($this->vendorIdentifier !== null) {
            $result['vendorIdentifier'] = $this->vendorIdentifier;
        }
        if ($this->maxPrice !== null) {
            $result['maxPrice'] = $this->maxPrice;
        }
        if ($this->minPrice !== null) {
            $result['minPrice'] = $this->minPrice;
        }
        if ($this->sameCity !== null) {
            $result['sameCity'] = $this->sameCity;
        }
        if ($this->minRating !== null) {
            $result['minRating'] = $this->minRating;
        }
        if ($this->vendorScore !== null) {
            $result['vendorScore'] = $this->vendorScore;
        }

        return $result;
    }

    // Getters

    public function getFreeShipping(): ?int
    {
        return $this->freeShipping;
    }

    public function setFreeShipping(?int $freeShipping): self
    {
        $this->freeShipping = $freeShipping;
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getVendorIdentifier(): ?string
    {
        return $this->vendorIdentifier;
    }

    public function setVendorIdentifier(?string $vendorIdentifier): self
    {
        $this->vendorIdentifier = $vendorIdentifier;
        return $this;
    }

    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(?int $maxPrice): self
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    // Setters

    public function getMinPrice(): ?int
    {
        return $this->minPrice;
    }

    public function setMinPrice(?int $minPrice): self
    {
        $this->minPrice = $minPrice;
        return $this;
    }

    public function getSameCity(): ?int
    {
        return $this->sameCity;
    }

    public function setSameCity(?int $sameCity): self
    {
        $this->sameCity = $sameCity;
        return $this;
    }

    public function getMinRating(): ?int
    {
        return $this->minRating;
    }

    public function setMinRating(?int $minRating): self
    {
        $this->minRating = $minRating;
        return $this;
    }

    public function getVendorScore(): ?int
    {
        return $this->vendorScore;
    }

    public function setVendorScore(?int $vendorScore): self
    {
        $this->vendorScore = $vendorScore;
        return $this;
    }
}