<?php

namespace Basalam\Webhook\Models;

use DateTime;

/**
 * Response model for client resources.
 */
class ClientResource implements \JsonSerializable
{
    private int $id;
    private int $customerId;
    private int $webhookId;
    private ?DateTime $createdAt;
    private ?DateTime $updatedAt;

    public function __construct(
        int       $id,
        int       $customerId,
        int       $webhookId,
        ?DateTime $createdAt = null,
        ?DateTime $updatedAt = null
    )
    {
        $this->id = $id;
        $this->customerId = $customerId;
        $this->webhookId = $webhookId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['customer_id'],
            $data['webhook_id'],
            isset($data['created_at']) ? new DateTime($data['created_at']) : null,
            isset($data['updated_at']) ? new DateTime($data['updated_at']) : null
        );
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->id,
            'customer_id' => $this->customerId,
            'webhook_id' => $this->webhookId,
        ];

        if ($this->createdAt !== null) {
            $result['created_at'] = $this->createdAt->format('Y-m-d H:i:s');
        }
        if ($this->updatedAt !== null) {
            $result['updated_at'] = $this->updatedAt->format('Y-m-d H:i:s');
        }

        return $result;
    }

    // Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function getWebhookId(): int
    {
        return $this->webhookId;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @return array
     */
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}