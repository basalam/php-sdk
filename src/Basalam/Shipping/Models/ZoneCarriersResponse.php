<?php

namespace Basalam\Shipping\Models;

use DateTime;

/**
 * ZoneCarriersResponse model.
 */
class ZoneCarriersResponse implements \JsonSerializable
{
    private int $id;
    private ?array $status;
    private ?VendorCarrierResponse $vendorCarrier;
    private ?array $config;
    private string $hint;
    private ?DateTime $createdAt;
    private ?DateTime $updatedAt;

    public function __construct(
        int $id,
        ?array $status,
        ?VendorCarrierResponse $vendorCarrier,
        ?array $config,
        string $hint,
        ?DateTime $createdAt,
        ?DateTime $updatedAt
    ) {
        $this->id = $id;
        $this->status = $status;
        $this->vendorCarrier = $vendorCarrier;
        $this->config = $config;
        $this->hint = $hint;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['status'] ?? null,
            isset($data['vendor_carrier']) ? VendorCarrierResponse::fromArray($data['vendor_carrier']) : null,
            $data['config'] ?? null,
            $data['hint'],
            isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            isset($data['updated_at']) ? new DateTime($data['updated_at']) : null
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['id'] = $this->id;
        $result['status'] = $this->status;
        $result['vendor_carrier'] = $this->vendorCarrier !== null ? $this->vendorCarrier->toArray() : null;
        $result['config'] = $this->config;
        $result['hint'] = $this->hint;
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

    public function getStatus(): ?array
    {
        return $this->status;
    }

    public function getVendorCarrier(): ?VendorCarrierResponse
    {
        return $this->vendorCarrier;
    }

    public function getConfig(): ?array
    {
        return $this->config;
    }

    public function getHint(): string
    {
        return $this->hint;
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
