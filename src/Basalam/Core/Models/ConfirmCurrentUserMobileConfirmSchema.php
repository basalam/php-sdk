<?php

namespace Basalam\Core\Models;

class ConfirmCurrentUserMobileConfirmSchema implements \JsonSerializable
{
    public ?int $verification_code;

    public function __construct(array $data)
    {
        $this->verification_code = $data['verification_code'] ?? null;
    }

    public function toArray(): array
    {
        return [
            'verification_code' => $this->verification_code,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}