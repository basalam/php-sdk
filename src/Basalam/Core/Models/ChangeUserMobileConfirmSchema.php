<?php

namespace Basalam\Core\Models;

class ChangeUserMobileConfirmSchema implements \JsonSerializable
{
    public ?string $mobile;
    public ?int $verification_code;

    public function __construct(array $data)
    {
        $this->mobile = $data['mobile'] ?? null;
        $this->verification_code = $data['verification_code'] ?? null;
    }

    public function toArray(): array
    {
        return [
            'mobile' => $this->mobile,
            'verification_code' => $this->verification_code,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}