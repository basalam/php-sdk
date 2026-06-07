<?php

namespace Basalam\Apps\Models;

/**
 * PreTransactionGatewayResource model.
 */
class PreTransactionGatewayResource implements \JsonSerializable
{
    private ?string $title;
    private ?string $logo;

    public function __construct(
        ?string $title,
        ?string $logo
    ) {
        $this->title = $title;
        $this->logo = $logo;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['title'] ?? null,
            $data['logo'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }
}
