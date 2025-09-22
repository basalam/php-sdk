<?php

namespace Basalam\Webhook\Models;

use DateTime;

/**
 * Response model for webhook log resources.
 */
class WebhookLogResource implements \JsonSerializable
{
    private int $id;
    private int $userId;
    private int $statusCode;
    private array $request;
    private string $response;
    private ?DateTime $createdAt;

    public function __construct(
        int       $id,
        int       $userId,
        int       $statusCode,
        array     $request,
        string    $response,
        ?DateTime $createdAt = null
    )
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->statusCode = $statusCode;
        $this->request = $request;
        $this->response = $response;
        $this->createdAt = $createdAt;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['user_id'],
            $data['status_code'],
            $data['request'],
            $data['response'],
            isset($data['created_at']) ? new DateTime($data['created_at']) : null
        );
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->id,
            'user_id' => $this->userId,
            'status_code' => $this->statusCode,
            'request' => $this->request,
            'response' => $this->response,
        ];

        if ($this->createdAt !== null) {
            $result['created_at'] = $this->createdAt->format('Y-m-d H:i:s');
        }

        return $result;
    }

    // Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getRequest(): array
    {
        return $this->request;
    }

    public function getResponse(): string
    {
        return $this->response;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
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