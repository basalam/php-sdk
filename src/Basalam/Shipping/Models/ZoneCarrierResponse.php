<?php

namespace Basalam\Shipping\Models;

use DateTime;

/**
 * ZoneCarrierResponse model.
 */
class ZoneCarrierResponse implements \JsonSerializable
{
    private int $id;
    private string $title;
    private int $carrierId;
    private int $vendorCarrierId;
    private string $hint;
    private ?array $status;
    private ?DateTime $createdAt;
    private ?DateTime $updatedAt;

    public function __construct(
        int $id,
        string $title,
        int $carrierId,
        int $vendorCarrierId,
        string $hint,
        ?array $status,
        ?DateTime $createdAt,
        ?DateTime $updatedAt
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->carrierId = $carrierId;
        $this->vendorCarrierId = $vendorCarrierId;
        $this->hint = $hint;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['title'],
            $data['carrier_id'],
            $data['vendor_carrier_id'],
            $data['hint'],
            $data['status'] ?? null,
            isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            isset($data['updated_at']) ? new DateTime($data['updated_at']) : null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['id'] = $this->id;
        $result['title'] = $this->title;
        $result['carrier_id'] = $this->carrierId;
        $result['vendor_carrier_id'] = $this->vendorCarrierId;
        $result['hint'] = $this->hint;
        $result['status'] = $this->status;
        $result['created_at'] = $this->createdAt !== null ? $this->createdAt->format('Y-m-d H:i:s') : null;
        $result['updated_at'] = $this->updatedAt !== null ? $this->updatedAt->format('Y-m-d H:i:s') : null;
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCarrierId(): int
    {
        return $this->carrierId;
    }

    public function getVendorCarrierId(): int
    {
        return $this->vendorCarrierId;
    }

    public function getHint(): string
    {
        return $this->hint;
    }

    public function getStatus(): ?array
    {
        return $this->status;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }
}
