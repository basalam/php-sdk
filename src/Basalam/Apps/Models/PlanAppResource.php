<?php

namespace Basalam\Apps\Models;

/**
 * PlanAppResource model.
 */
class PlanAppResource implements \JsonSerializable
{
    private ?int $id;
    private ?string $slug;
    private ?string $title;
    private ?string $logo;

    public function __construct(
        ?int $id,
        ?string $slug,
        ?string $title,
        ?string $logo
    ) {
        $this->id = $id;
        $this->slug = $slug;
        $this->title = $title;
        $this->logo = $logo;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['slug'] ?? null,
            $data['title'] ?? null,
            $data['logo'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->id !== null) {
            $result['id'] = $this->id;
        }
        if ($this->slug !== null) {
            $result['slug'] = $this->slug;
        }
        if ($this->title !== null) {
            $result['title'] = $this->title;
        }
        if ($this->logo !== null) {
            $result['logo'] = $this->logo;
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }
}
