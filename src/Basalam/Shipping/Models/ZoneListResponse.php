<?php

namespace Basalam\Shipping\Models;

use DateTime;

/**
 * ZoneListResponse model.
 */
class ZoneListResponse implements \JsonSerializable
{
    private int $id;
    private string $title;
    private array $status;
    private ?array $locations;
    private ?DateTime $createdAt;
    private ?ZoneHint $hint;
    private ?ZoneHint $excludeHint;

    public function __construct(
        int $id,
        string $title,
        array $status,
        ?array $locations,
        ?DateTime $createdAt,
        ?ZoneHint $hint,
        ?ZoneHint $excludeHint
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->status = $status;
        $this->locations = $locations;
        $this->createdAt = $createdAt;
        $this->hint = $hint;
        $this->excludeHint = $excludeHint;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['title'],
            $data['status'],
            isset($data['locations']) ? array_map(fn($item) => ZonesLocation::fromArray($item), $data['locations']) : null,
            isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            isset($data['hint']) ? ZoneHint::fromArray($data['hint']) : null,
            isset($data['exclude_hint']) ? ZoneHint::fromArray($data['exclude_hint']) : null
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
        $result['hint'] = $this->hint !== null ? $this->hint->toArray() : null;
        $result['exclude_hint'] = $this->excludeHint !== null ? $this->excludeHint->toArray() : null;
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

    public function getHint(): ?ZoneHint
    {
        return $this->hint;
    }

    public function getExcludeHint(): ?ZoneHint
    {
        return $this->excludeHint;
    }
}
