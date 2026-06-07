<?php

namespace Basalam\Shipping\Models;

/**
 * ShippingZoneWithThreshold model.
 */
class ShippingZoneWithThreshold implements \JsonSerializable
{
    private int $id;
    private string $title;
    private ?int $threshold;

    public function __construct(
        int $id,
        string $title,
        ?int $threshold
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->threshold = $threshold;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['title'],
            $data['threshold'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['id'] = $this->id;
        $result['title'] = $this->title;
        if ($this->threshold !== null) {
            $result['threshold'] = $this->threshold;
        }
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

    public function getThreshold(): ?int
    {
        return $this->threshold;
    }
}
