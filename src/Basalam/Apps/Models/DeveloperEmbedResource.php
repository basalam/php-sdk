<?php

namespace Basalam\Apps\Models;

/**
 * DeveloperEmbedResource model.
 */
class DeveloperEmbedResource implements \JsonSerializable
{
    private ?int $id;
    private ?string $name;
    private ?string $email;
    private ?string $mobile;

    public function __construct(
        ?int $id,
        ?string $name,
        ?string $email,
        ?string $mobile
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->mobile = $mobile;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['name'] ?? null,
            $data['email'] ?? null,
            $data['mobile'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->id !== null) {
            $result['id'] = $this->id;
        }
        if ($this->name !== null) {
            $result['name'] = $this->name;
        }
        if ($this->email !== null) {
            $result['email'] = $this->email;
        }
        if ($this->mobile !== null) {
            $result['mobile'] = $this->mobile;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }
}
