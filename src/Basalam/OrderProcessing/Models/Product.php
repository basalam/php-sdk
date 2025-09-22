<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Product model.
 */
class Product implements JsonSerializable
{
    private int $id;
    private ?string $name;
    private int $categoryId;
    private array $photos;

    public function __construct(
        int     $id,
        int     $categoryId,
        array   $photos,
        ?string $name = null
    )
    {
        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->photos = $photos;
        $this->name = $name;
    }

    public static function fromArray(array $data): self
    {
        $photos = array_map(fn($photo) => FileResponse::fromArray($photo), $data['photos']);

        return new self(
            $data['id'],
            $data['category_id'],
            $photos,
            $data['name'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category_id' => $this->categoryId,
            'photos' => array_map(fn($photo) => $photo->toArray(), $this->photos),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}

