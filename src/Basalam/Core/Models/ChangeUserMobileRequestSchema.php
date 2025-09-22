<?php

namespace Basalam\Core\Models;

class ChangeUserMobileRequestSchema implements \JsonSerializable
{
    public string $mobile;

    public function __construct(array $data)
    {
        $this->mobile = $data['mobile'];
    }

    public function toArray(): array
    {
        return [
            'mobile' => $this->mobile,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}