<?php

namespace Basalam\Chat\Models;

/**
 * Get messages request model
 */
class GetMessagesRequest implements \JsonSerializable
{
    private int $chatId;
    private ?int $messageId;
    private int $limit;
    private string $order;
    private string $cmp;

    public function __construct(
        int    $chatId,
        ?int   $messageId = null,
        int    $limit = 20,
        string $order = 'desc',
        string $cmp = 'lt'
    )
    {
        $this->chatId = $chatId;
        $this->messageId = $messageId;
        $this->limit = $limit;
        $this->order = $order;
        $this->cmp = $cmp;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['chat_id'],
            $data['message_id'] ?? null,
            $data['limit'] ?? 20,
            $data['order'] ?? 'desc',
            $data['cmp'] ?? 'lt'
        );
    }

    public function toArray(): array
    {
        $params = [
            'chat_id' => $this->chatId,
            'limit' => $this->limit,
            'order' => $this->order,
            'cmp' => $this->cmp
        ];

        if ($this->messageId !== null) {
            $params['message_id'] = $this->messageId;
        }

        return $params;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}