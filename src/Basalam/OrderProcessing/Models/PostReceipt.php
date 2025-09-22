<?php

namespace Basalam\OrderProcessing\Models;

use JsonSerializable;

/**
 * Post receipt model.
 */
class PostReceipt implements JsonSerializable
{
    private int $id;
    private ?string $trackingCode;
    private ?int $finalPostCost;
    private string $createdAt;
    private string $updatedAt;
    private ?string $trackingLink;
    private ?string $phoneNumber;
    private ?PostReceiptAttachment $attachment;
    private bool $editable;
    private bool $edited;

    public function __construct(
        int                    $id,
        string                 $createdAt,
        string                 $updatedAt,
        bool                   $editable,
        bool                   $edited,
        ?string                $trackingCode = null,
        ?int                   $finalPostCost = null,
        ?string                $trackingLink = null,
        ?string                $phoneNumber = null,
        ?PostReceiptAttachment $attachment = null
    )
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->editable = $editable;
        $this->edited = $edited;
        $this->trackingCode = $trackingCode;
        $this->finalPostCost = $finalPostCost;
        $this->trackingLink = $trackingLink;
        $this->phoneNumber = $phoneNumber;
        $this->attachment = $attachment;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['created_at'],
            $data['updated_at'],
            $data['editable'],
            $data['edited'],
            $data['tracking_code'] ?? null,
            $data['final_post_cost'] ?? null,
            $data['tracking_link'] ?? null,
            $data['phone_number'] ?? null,
            isset($data['attachment']) ? PostReceiptAttachment::fromArray($data['attachment']) : null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'tracking_code' => $this->trackingCode,
            'final_post_cost' => $this->finalPostCost,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'tracking_link' => $this->trackingLink,
            'phone_number' => $this->phoneNumber,
            'attachment' => $this->attachment?->toArray(),
            'editable' => $this->editable,
            'edited' => $this->edited,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}