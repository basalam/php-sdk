<?php

namespace Basalam\Apps\Models;

/**
 * PreTransactionPayMethodResource model.
 */
class PreTransactionPayMethodResource implements \JsonSerializable
{
    private ?int $id;
    private ?string $title;
    private ?string $driver;
    private ?bool $enabled;

    public function __construct(
        ?int $id,
        ?string $title,
        ?string $driver,
        ?bool $enabled
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->driver = $driver;
        $this->enabled = $enabled;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['title'] ?? null,
            $data['driver'] ?? null,
            $data['enabled'] ?? null
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
        if ($this->driver !== null) {
            $result['driver'] = $this->driver;
        }
        if ($this->enabled !== null) {
            $result['enabled'] = $this->enabled;
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

    public function getDriver(): ?string
    {
        return $this->driver;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }
}
