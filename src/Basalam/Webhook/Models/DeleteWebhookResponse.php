<?php

namespace Basalam\Webhook\Models;

use DateTime;

/**
 * Response model for webhook deletion.
 */
class DeleteWebhookResponse
{
    private int $id;
    private ?DateTime $deletedAt;

    public function __construct(int $id, ?DateTime $deletedAt = null)
    {
        $this->id = $id;
        $this->deletedAt = $deletedAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            isset($data['deleted_at']) ? new DateTime($data['deleted_at']) : null
        );
    }

    public function toArray(): array
    {
        $result = ['id' => $this->id];

        if ($this->deletedAt !== null) {
            $result['deleted_at'] = $this->deletedAt->format('Y-m-d H:i:s');
        }

        return $result;
    }

    // Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }
}