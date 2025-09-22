<?php

namespace Basalam\Webhook\Models;

/**
 * Request model for registering a client to a webhook.
 */
class RegisterClientRequest
{
    private int $webhookId;

    public function __construct(int $webhookId)
    {
        $this->webhookId = $webhookId;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['webhook_id']);
    }

    public function toArray(): array
    {
        return [
            'webhook_id' => $this->webhookId,
        ];
    }

    // Getter

    public function getWebhookId(): int
    {
        return $this->webhookId;
    }

    // Setter
    public function setWebhookId(int $webhookId): self
    {
        $this->webhookId = $webhookId;
        return $this;
    }
}