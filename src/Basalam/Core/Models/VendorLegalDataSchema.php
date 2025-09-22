<?php

namespace Basalam\Core\Models;

class VendorLegalDataSchema implements \JsonSerializable
{
    public ?bool $is_legal;
    public ?string $economic_number;
    public ?string $national_id;
    public ?string $legal_name;
    public ?string $registration_number;
    public ?int $establishment_announcement_file;
    public ?int $last_change_announcement_file;
    public ?int $vendor_legal_type;
    public ?string $board_phone_number;
    public ?string $board_national_id;

    public function __construct(array $data = [])
    {
        $this->is_legal = $data['is_legal'] ?? null;
        $this->economic_number = $data['economic_number'] ?? null;
        $this->national_id = $data['national_id'] ?? null;
        $this->legal_name = $data['legal_name'] ?? null;
        $this->registration_number = $data['registration_number'] ?? null;
        $this->establishment_announcement_file = $data['establishment_announcement_file'] ?? null;
        $this->last_change_announcement_file = $data['last_change_announcement_file'] ?? null;
        $this->vendor_legal_type = $data['vendor_legal_type'] ?? null;
        $this->board_phone_number = $data['board_phone_number'] ?? null;
        $this->board_national_id = $data['board_national_id'] ?? null;
    }

    public function toArray(): array
    {
        return array_filter([
            'is_legal' => $this->is_legal,
            'economic_number' => $this->economic_number,
            'national_id' => $this->national_id,
            'legal_name' => $this->legal_name,
            'registration_number' => $this->registration_number,
            'establishment_announcement_file' => $this->establishment_announcement_file,
            'last_change_announcement_file' => $this->last_change_announcement_file,
            'vendor_legal_type' => $this->vendor_legal_type,
            'board_phone_number' => $this->board_phone_number,
            'board_national_id' => $this->board_national_id,
        ], fn($v) => $v !== null);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}