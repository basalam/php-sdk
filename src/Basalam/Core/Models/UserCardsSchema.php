<?php

namespace Basalam\Core\Models;

class UserCardsSchema implements \JsonSerializable
{
    public ?string $card_number;
    public ?string $sheba_number;
    public ?string $sheba_owner;
    public ?string $birthday;
    public ?string $national_code;
    public ?int $bank_account_status;
    public ?int $verify_type;
    public ?int $operator_id;

    public function __construct(array $data = [])
    {
        $this->card_number = $data['card_number'] ?? null;
        $this->sheba_number = $data['sheba_number'] ?? null;
        $this->sheba_owner = $data['sheba_owner'] ?? null;
        $this->birthday = $data['birthday'] ?? null;
        $this->national_code = $data['national_code'] ?? null;
        $this->bank_account_status = $data['bank_account_status'] ?? null;
        $this->verify_type = $data['verify_type'] ?? null;
        $this->operator_id = $data['operator_id'] ?? null;
    }

    public function toArray(): array
    {
        $result = [];

        // Use card_number as-is
        if ($this->card_number !== null) {
            $result['card_number'] = $this->card_number;
        }
        if ($this->sheba_number !== null) {
            $result['sheba_number'] = $this->sheba_number;
        }
        if ($this->sheba_owner !== null) {
            $result['sheba_owner'] = $this->sheba_owner;
        }
        if ($this->birthday !== null) {
            $result['birthday'] = $this->birthday;
        }
        if ($this->national_code !== null) {
            $result['national_code'] = $this->national_code;
        }
        if ($this->bank_account_status !== null) {
            $result['bank_account_status'] = $this->bank_account_status;
        }
        if ($this->verify_type !== null) {
            $result['verify_type'] = $this->verify_type;
        }
        if ($this->operator_id !== null) {
            $result['operator_id'] = $this->operator_id;
        }

        return $result;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}