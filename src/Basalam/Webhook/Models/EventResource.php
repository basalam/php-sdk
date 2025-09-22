<?php

namespace Basalam\Webhook\Models;

/**
 * Event resource model.
 */
class EventResource implements \JsonSerializable
{
    private int $id;
    private string $name;
    private ?string $description;
    private ?array $sampleData;
    private ?string $scopes;

    public function __construct(
        int     $id,
        string  $name,
        ?string $description = null,
        ?array  $sampleData = null,
        ?string $scopes = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->sampleData = $sampleData;
        $this->scopes = $scopes;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['description'] ?? null,
            $data['sample_data'] ?? null,
            $data['scopes'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->id,
            'name' => $this->name,
        ];

        if ($this->description !== null) {
            $result['description'] = $this->description;
        }
        if ($this->sampleData !== null) {
            $result['sample_data'] = $this->sampleData;
        }
        if ($this->scopes !== null) {
            $result['scopes'] = $this->scopes;
        }

        return $result;
    }

    // Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getSampleData(): ?array
    {
        return $this->sampleData;
    }

    public function getScopes(): ?string
    {
        return $this->scopes;
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