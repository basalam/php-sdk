<?php

namespace Basalam\Shipping\Models;

use DateTime;

/**
 * ZoneResponse model.
 */
class ZoneResponse implements \JsonSerializable
{
    private int $id;
    private string $title;
    private array $status;
    private ?array $locations;
    private ?DateTime $createdAt;

    public function __construct(
        int $id,
        string $title,
        array $status,
        ?array $locations,
        ?DateTime $createdAt
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->status = $status;
        $this->locations = $locations;
        $this->createdAt = $createdAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['title'],
            $data['status'],
            isset($data['locations']) ? array_map(fn($item) => ZonesLocation::fromArray($item), $data['locations']) : null,
            isset($data['created_at']) ? new DateTime($data['created_at']) : null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['id'] = $this->id;
        $result['title'] = $this->title;
        $result['status'] = $this->status;
        $result['locations'] = $this->locations !== null ? array_map(fn($item) => $item->toArray(), $this->locations) : null;
        $result['created_at'] = $this->createdAt !== null ? $this->createdAt->format('Y-m-d H:i:s') : null;
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

    public function getStatus(): array
    {
        return $this->status;
    }

    public function getLocations(): ?array
    {
        return $this->locations;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }
}
