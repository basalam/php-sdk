<?php

namespace Basalam\Shipping\Models;

/**
 * CreateProfileRequest model.
 */
class CreateProfileRequest implements \JsonSerializable
{
    private string $title;
    private ?int $vendorId;

    public function __construct(
        string $title,
        ?int $vendorId
    ) {
        $this->title = $title;
        $this->vendorId = $vendorId;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['title'],
            $data['vendor_id'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['title'] = $this->title;
        if ($this->vendorId !== null) {
            $result['vendor_id'] = $this->vendorId;
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getVendorId(): ?int
    {
        return $this->vendorId;
    }
}
