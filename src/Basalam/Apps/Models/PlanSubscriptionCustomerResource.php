<?php

namespace Basalam\Apps\Models;

/**
 * PlanSubscriptionCustomerResource model.
 */
class PlanSubscriptionCustomerResource implements \JsonSerializable
{
    private ?int $id;
    private ?string $name;

    public function __construct(
        ?int $id,
        ?string $name
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['name'] ?? null
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
}
