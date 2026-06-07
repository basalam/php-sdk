<?php

namespace Basalam\Apps\Models;

/**
 * PreTransactionAppResource model.
 */
class PreTransactionAppResource implements \JsonSerializable
{
    private ?int $id;
    private ?string $title;
    private ?string $logo;
    private ?string $slug;
    private ?string $link;
    private ?string $ctaLink;
    private ?string $description;

    public function __construct(
        ?int $id,
        ?string $title,
        ?string $logo,
        ?string $slug,
        ?string $link,
        ?string $ctaLink,
        ?string $description
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->logo = $logo;
        $this->slug = $slug;
        $this->link = $link;
        $this->ctaLink = $ctaLink;
        $this->description = $description;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['title'] ?? null,
            $data['logo'] ?? null,
            $data['slug'] ?? null,
            $data['link'] ?? null,
            $data['cta_link'] ?? null,
            $data['description'] ?? null
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
        if ($this->logo !== null) {
            $result['logo'] = $this->logo;
        }
        if ($this->slug !== null) {
            $result['slug'] = $this->slug;
        }
        if ($this->link !== null) {
            $result['link'] = $this->link;
        }
        if ($this->ctaLink !== null) {
            $result['cta_link'] = $this->ctaLink;
        }
        if ($this->description !== null) {
            $result['description'] = $this->description;
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function getCtaLink(): ?string
    {
        return $this->ctaLink;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
