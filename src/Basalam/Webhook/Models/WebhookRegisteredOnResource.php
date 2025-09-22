<?php

namespace Basalam\Webhook\Models;

use DateTime;

/**
 * Response model for webhook registration resources.
 */
class WebhookRegisteredOnResource implements \JsonSerializable
{
    private int $id;
    private int $serviceId;
    private int $customerId;
    private array $events;
    private ?bool $isActive;
    private ?DateTime $registeredAt;

    public function __construct(
        int       $id,
        int       $serviceId,
        int       $customerId,
        array     $events,
        ?bool     $isActive = null,
        ?DateTime $registeredAt = null
    )
    {
        $this->id = $id;
        $this->serviceId = $serviceId;
        $this->customerId = $customerId;
        $this->events = $events;
        $this->isActive = $isActive;
        $this->registeredAt = $registeredAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['service_id'],
            $data['customer_id'],
            $data['events'],
            $data['is_active'] ?? null,
            isset($data['registered_at']) ? new DateTime($data['registered_at']) : null
        );
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->id,
            'service_id' => $this->serviceId,
            'customer_id' => $this->customerId,
            'events' => $this->events,
        ];

        if ($this->isActive !== null) {
            $result['is_active'] = $this->isActive;
        }
        if ($this->registeredAt !== null) {
            $result['registered_at'] = $this->registeredAt->format('Y-m-d H:i:s');
        }

        return $result;
    }

    // Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getServiceId(): int
    {
        return $this->serviceId;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function getRegisteredAt(): ?DateTime
    {
        return $this->registeredAt;
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