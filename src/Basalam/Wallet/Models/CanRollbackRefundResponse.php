<?php

namespace Basalam\Wallet\Models;

/**
 * Can rollback refund response model.
 */
class CanRollbackRefundResponse implements \JsonSerializable
{
    private bool $status;
    private string $message;

    public function __construct(bool $status, string $message)
    {
        $this->status = $status;
        $this->message = $message;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['status'],
            $data['message']
        );
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}