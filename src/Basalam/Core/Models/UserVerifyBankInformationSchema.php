<?php

namespace Basalam\Core\Models;

class UserVerifyBankInformationSchema implements \JsonSerializable
{
    public ?int $bank_information_id;
    public ?string $national_code;
    public ?string $birthday;

    public function __construct(array $data)
    {
        $this->bank_information_id = $data['bank_information_id'] ?? null;
        $this->national_code = $data['national_code'] ?? null;
        $this->birthday = $data['birthday'] ?? null;
    }

    public function toArray(): array
    {
        return [
            'bank_information_id' => $this->bank_information_id,
            'national_code' => $this->national_code,
            'birthday' => $this->birthday,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}