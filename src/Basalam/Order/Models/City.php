<?php

namespace Basalam\Order\Models;

/**
 * City model
 */
class City implements \JsonSerializable
{
    private ?int $id;
    private ?string $title;
    private ?City $parent;

    public function __construct(
        ?int    $id = null,
        ?string $title = null,
        ?City   $parent = null
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->parent = $parent;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['title'] ?? null,
            isset($data['parent']) ? self::fromArray($data['parent']) : null
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
        if ($this->parent !== null) {
            $result['parent'] = $this->parent->toArray();
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

    public function getParent(): ?City
    {
        return $this->parent;
    }

    /**
     * Specify data which should be serialized to JSON
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}