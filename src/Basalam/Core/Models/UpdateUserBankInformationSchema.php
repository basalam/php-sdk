<?php

namespace Basalam\Core\Models;

class UpdateUserBankInformationSchema implements \JsonSerializable
{
    public ?int $user_id;
    public ?string $card_number;
    public ?string $sheba_number;
    public ?string $account_owner;
    public ?int $status;
    public ?string $bank_name;
    public ?string $sheba_status;
    public ?string $bank_account_number;

    public function __construct(array $data = [])
    {
        $this->user_id = $data['user_id'] ?? null;
        $this->card_number = $data['card_number'] ?? null;
        $this->sheba_number = $data['sheba_number'] ?? null;
        $this->account_owner = $data['account_owner'] ?? null;
        $this->status = $data['status'] ?? null;
        $this->bank_name = $data['bank_name'] ?? null;
        $this->sheba_status = $data['sheba_status'] ?? null;
        $this->bank_account_number = $data['bank_account_number'] ?? null;
    }

    public function toArray(): array
    {
        return array_filter([
            'user_id' => $this->user_id,
            'card_number' => $this->card_number,
            'sheba_number' => $this->sheba_number,
            'account_owner' => $this->account_owner,
            'status' => $this->status,
            'bank_name' => $this->bank_name,
            'sheba_status' => $this->sheba_status,
            'bank_account_number' => $this->bank_account_number,
        ], fn($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}