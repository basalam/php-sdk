<?php

namespace Basalam\Webhook\Models;

use DateTime;

/**
 * Response model for client unregistration.
 */
class UnRegisterClientResponse
{
    private int $webhookId;
    private int $customerId;
    private ?DateTime $deletedAt;

    public function __construct(
        int       $webhookId,
        int       $customerId,
        ?DateTime $deletedAt = null
    )
    {
        $this->webhookId = $webhookId;
        $this->customerId = $customerId;
        $this->deletedAt = $deletedAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['webhook_id'],
            $data['customer_id'],
            isset($data['deleted_at']) ? new DateTime($data['deleted_at']) : null
        );
    }

    public function toArray(): array
    {
        $result = [
            'webhook_id' => $this->webhookId,
            'customer_id' => $this->customerId,
        ];

        if ($this->deletedAt !== null) {
            $result['deleted_at'] = $this->deletedAt->format('Y-m-d H:i:s');
        }

        return $result;
    }

    // Getters

    public function getWebhookId(): int
    {
        return $this->webhookId;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }
}