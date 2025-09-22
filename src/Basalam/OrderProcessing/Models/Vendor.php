<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Vendor model.
 */
class Vendor implements JsonSerializable
{
    private int $id;
    private string $identifier;
    private string $title;
    private City $city;
    private User $owner;
    private ?FileResponse $logo;

    public function __construct(
        int           $id,
        string        $identifier,
        string        $title,
        City          $city,
        User          $owner,
        ?FileResponse $logo = null
    )
    {
        $this->id = $id;
        $this->identifier = $identifier;
        $this->title = $title;
        $this->city = $city;
        $this->owner = $owner;
        $this->logo = $logo;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['identifier'],
            $data['title'],
            City::fromArray($data['city']),
            User::fromArray($data['owner']),
            isset($data['logo']) ? FileResponse::fromArray($data['logo']) : null
        );
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCity(): City
    {
        return $this->city;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }

    public function getLogo(): ?FileResponse
    {
        return $this->logo;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'identifier' => $this->identifier,
            'title' => $this->title,
            'city' => $this->city->toArray(),
            'owner' => $this->owner->toArray(),
            'logo' => $this->logo?->toArray(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}