<?php

namespace Basalam\Core\Models;

class UserVerificationSchema implements \JsonSerializable
{
    public string $national_code;
    public string $birthday;

    public function __construct(array $data)
    {
        $this->national_code = $data['national_code'];
        $this->birthday = $data['birthday'];
    }

    public function toArray(): array
    {
        return [
            'national_code' => $this->national_code,
            'birthday' => $this->birthday,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}