<?php

namespace Basalam\Webhook\Models;

/**
 * Request model for unregistering a client from a webhook.
 */
class UnRegisterClientRequest
{
    private int $webhookId;
    private ?int $customerId;

    public function __construct(int $webhookId, ?int $customerId = null)
    {
        $this->webhookId = $webhookId;
        $this->customerId = $customerId;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['webhook_id'],
            $data['customer_id'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = ['webhook_id' => $this->webhookId];

        if ($this->customerId !== null) {
            $result['customer_id'] = $this->customerId;
        }

        return $result;
    }

    // Getters

    public function getWebhookId(): int
    {
        return $this->webhookId;
    }

    public function setWebhookId(int $webhookId): self
    {
        $this->webhookId = $webhookId;
        return $this;
    }

    // Setters

    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    public function setCustomerId(?int $customerId): self
    {
        $this->customerId = $customerId;
        return $this;
    }
}