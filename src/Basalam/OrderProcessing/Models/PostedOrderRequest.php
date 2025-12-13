<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Request model for confirming a parcel as posted.
 */
class PostedOrderRequest implements JsonSerializable
{
    private int $shippingMethod;
    private ?string $trackingCode;

    public function __construct(int $shippingMethod, ?string $trackingCode = null)
    {
        $this->shippingMethod = $shippingMethod;
        $this->trackingCode = $trackingCode;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['shipping_method'],
            $data['tracking_code'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [
            'shipping_method' => $this->shippingMethod,
        ];

        if ($this->trackingCode !== null) {
            $result['tracking_code'] = $this->trackingCode;
        }

        return $result;
    }

    public function getShippingMethod(): int
    {
        return $this->shippingMethod;
    }

    public function getTrackingCode(): ?string
    {
        return $this->trackingCode;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
