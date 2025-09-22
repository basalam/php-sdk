<?php

namespace Basalam\Webhook\Models;

/**
 * Service resource model.
 */
class ServiceResource implements \JsonSerializable
{
    private ?int $id;
    private ?string $title;
    private ?string $description;
    private ?bool $isVerified;
    private ?bool $isActive;
    private ?string $createdAt;

    public function __construct(
        ?int    $id = null,
        ?string $title = null,
        ?string $description = null,
        ?bool   $isVerified = null,
        ?bool   $isActive = null,
        ?string $createdAt = null
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->isVerified = $isVerified;
        $this->isActive = $isActive;
        $this->createdAt = $createdAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['title'] ?? null,
            $data['description'] ?? null,
            $data['is_verified'] ?? null,
            $data['is_active'] ?? null,
            $data['created_at'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];

        if ($this->id !== null) {
            $result['id'] = $this->id;
        }
        if ($this->title !== null) {
            $result['title'] = $this->title;
        }
        if ($this->description !== null) {
            $result['description'] = $this->description;
        }
        if ($this->isVerified !== null) {
            $result['is_verified'] = $this->isVerified;
        }
        if ($this->isActive !== null) {
            $result['is_active'] = $this->isActive;
        }
        if ($this->createdAt !== null) {
            $result['created_at'] = $this->createdAt;
        }

        return $result;
    }

    // Getters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @return array
     */
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}