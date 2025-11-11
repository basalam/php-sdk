<?php

namespace Basalam\Chat\Models;

/**
 * Represents the overall response structure from the Bot API.
 */
class BotApiResponse implements \JsonSerializable
{
    private bool $ok;
    private mixed $result;
    private ?string $description;
    private ?int $errorCode;

    public static function fromArray(array $data): self
    {
        $instance = new self();
        $instance->ok = $data['ok'];
        $instance->result = $data['result'] ?? null;
        $instance->description = $data['description'] ?? null;
        $instance->errorCode = $data['error_code'] ?? null;
        return $instance;
    }

    public function getOk(): bool
    {
        return $this->ok;
    }

    public function getResult(): mixed
    {
        return $this->result;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getErrorCode(): ?int
    {
        return $this->errorCode;
    }

    public function toArray(): array
    {
        return [
            'ok' => $this->ok,
            'result' => $this->result,
            'description' => $this->description,
            'error_code' => $this->errorCode,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
