<?php

namespace Basalam\Core\Models;

use DateTime;

/**
 * ProductPriceHistoryItemResponse model.
 */
class ProductPriceHistoryItemResponse implements \JsonSerializable
{
    private DateTime $changeTime;
    private int $price;
    private int $discountedPrice;

    public function __construct(
        DateTime $changeTime,
        int $price,
        int $discountedPrice
    ) {
        $this->changeTime = $changeTime;
        $this->price = $price;
        $this->discountedPrice = $discountedPrice;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            new DateTime($data['change_time']),
            $data['price'],
            $data['discounted_price']
        );
    }

    public function toArray(): array
    {
        return [
            'change_time' => $this->changeTime->format('Y-m-d H:i:s'),
            'price' => $this->price,
            'discounted_price' => $this->discountedPrice,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getChangeTime(): DateTime
    {
        return $this->changeTime;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getDiscountedPrice(): int
    {
        return $this->discountedPrice;
    }
}
