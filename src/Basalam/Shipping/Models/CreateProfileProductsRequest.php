<?php

namespace Basalam\Shipping\Models;

/**
 * CreateProfileProductsRequest model.
 */
class CreateProfileProductsRequest implements \JsonSerializable
{
    private ?array $productIds;
    private ?bool $allProducts;

    public function __construct(
        ?array $productIds,
        ?bool $allProducts
    ) {
        $this->productIds = $productIds;
        $this->allProducts = $allProducts;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['product_ids'] ?? null,
            $data['all_products'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->productIds !== null) {
            $result['product_ids'] = $this->productIds;
        }
        if ($this->allProducts !== null) {
            $result['all_products'] = $this->allProducts;
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getProductIds(): ?array
    {
        return $this->productIds;
    }

    public function getAllProducts(): ?bool
    {
        return $this->allProducts;
    }
}
