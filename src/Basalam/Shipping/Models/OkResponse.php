<?php

namespace Basalam\Shipping\Models;

/**
 * OkResponse model.
 */
class OkResponse implements \JsonSerializable
{
    private string $message;

    public function __construct(
        string $message
    ) {
        $this->message = $message;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['message']
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['message'] = $this->message;
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
