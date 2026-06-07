<?php

namespace Basalam\Core\Models;

/**
 * ProductPriceHistoryResponse model.
 */
class ProductPriceHistoryResponse implements \JsonSerializable
{
    /** @var ProductPriceHistoryItemResponse[] */
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn($item) => ProductPriceHistoryItemResponse::fromArray($item), $data['data'] ?? [])
        );
    }

    public function toArray(): array
    {
        return [
            'data' => array_map(fn($item) => $item->toArray(), $this->data),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    /**
     * @return ProductPriceHistoryItemResponse[]
     */
    public function getData(): array
    {
        return $this->data;
    }
}
