<?php

namespace Basalam\Wallet\Models;

/**
 * Reference response model.
 */
class ReferenceResponse implements \JsonSerializable
{
    private int $referenceTypeId;
    private string $title;
    private string $slug;
    private int $referenceId;

    public function __construct(
        int    $referenceTypeId,
        string $title,
        string $slug,
        int    $referenceId
    )
    {
        $this->referenceTypeId = $referenceTypeId;
        $this->title = $title;
        $this->slug = $slug;
        $this->referenceId = $referenceId;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['reference_type_id'],
            $data['title'],
            $data['slug'],
            $data['reference_id']
        );
    }

    public function toArray(): array
    {
        return [
            'reference_type_id' => $this->referenceTypeId,
            'title' => $this->title,
            'slug' => $this->slug,
            'reference_id' => $this->referenceId,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getReferenceTypeId(): int
    {
        return $this->referenceTypeId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getReferenceId(): int
    {
        return $this->referenceId;
    }
}