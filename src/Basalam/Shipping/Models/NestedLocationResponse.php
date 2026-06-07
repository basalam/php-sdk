<?php

namespace Basalam\Shipping\Models;

/**
 * NestedLocationResponse model.
 */
class NestedLocationResponse implements \JsonSerializable
{
    private int $id;
    private string $title;
    private int $parentId;
    private string $concatParents;
    private ?array $children;

    public function __construct(
        int $id,
        string $title,
        int $parentId,
        string $concatParents,
        ?array $children
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->parentId = $parentId;
        $this->concatParents = $concatParents;
        $this->children = $children;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['title'],
            $data['parent_id'],
            $data['concat_parents'],
            isset($data['children']) ? array_map(fn($item) => NestedLocationResponse::fromArray($item), $data['children']) : null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['id'] = $this->id;
        $result['title'] = $this->title;
        $result['parent_id'] = $this->parentId;
        $result['concat_parents'] = $this->concatParents;
        $result['children'] = $this->children !== null ? array_map(fn($item) => $item->toArray(), $this->children) : null;
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

    public function getParentId(): int
    {
        return $this->parentId;
    }

    public function getConcatParents(): string
    {
        return $this->concatParents;
    }

    public function getChildren(): ?array
    {
        return $this->children;
    }
}
