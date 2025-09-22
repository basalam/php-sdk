<?php

namespace Basalam\Core\Models;

class UserCardsOtpSchema implements \JsonSerializable
{
    public ?string $card_number;
    public ?string $otp_code;

    public function __construct(array $data)
    {
        $this->card_number = $data['card_number'] ?? null;
        $this->otp_code = $data['otp_code'] ?? null;
    }

    public function toArray(): array
    {
        return [
            'card_number' => $this->card_number,
            'otp_code' => $this->otp_code,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}