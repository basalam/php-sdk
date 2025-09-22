<?php

namespace Basalam\Wallet\Models;

/**
 * Credit type response model.
 */
class CreditTypeResponse implements \JsonSerializable
{
    private int $id;
    private string $title;
    private ?CreditTypeResponse $parent;

    public function __construct(int $id, string $title, ?CreditTypeResponse $parent = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->parent = $parent;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['title'],
            isset($data['parent']) ? self::fromArray($data['parent']) : null
        );
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->id,
            'title' => $this->title,
        ];

        if ($this->parent !== null) {
            $result['parent'] = $this->parent->toArray();
        }

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

    public function getParent(): ?CreditTypeResponse
    {
        return $this->parent;
    }
}