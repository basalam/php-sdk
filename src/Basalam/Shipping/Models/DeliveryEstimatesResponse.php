<?php

namespace Basalam\Shipping\Models;

/**
 * DeliveryEstimatesResponse model.
 */
class DeliveryEstimatesResponse implements \JsonSerializable
{
    private int $id;
    private string $title;
    private string $estimateHint;
    private string $estimateType;

    public function __construct(
        int $id,
        string $title,
        string $estimateHint,
        string $estimateType
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->estimateHint = $estimateHint;
        $this->estimateType = $estimateType;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['title'],
            $data['estimate_hint'],
            $data['estimate_type']
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['id'] = $this->id;
        $result['title'] = $this->title;
        $result['estimate_hint'] = $this->estimateHint;
        $result['estimate_type'] = $this->estimateType;
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getEstimateHint(): string
    {
        return $this->estimateHint;
    }

    public function getEstimateType(): string
    {
        return $this->estimateType;
    }
}
