<?php

namespace Basalam\Wallet\Models;

/**
 * History pagination response model.
 */
class HistoryPaginationResponse implements \JsonSerializable
{
    private array $data;
    private int $total;
    private int $perPage;
    private int $currentPage;
    private int $lastPage;
    private ?int $from;
    private ?int $to;

    public function __construct(
        array $data,
        int   $total,
        int   $perPage,
        int   $currentPage,
        int   $lastPage,
        ?int  $from,
        ?int  $to
    )
    {
        $this->data = $data;
        $this->total = $total;
        $this->perPage = $perPage;
        $this->currentPage = $currentPage;
        $this->lastPage = $lastPage;
        $this->from = $from;
        $this->to = $to;
    }

    public static function fromArray(array $data): self
    {
        $items = array_map(fn($item) => HistoryItemResponse::fromArray($item), $data['data']);

        return new self(
            $items,
            $data['total'],
            $data['per_page'],
            $data['current_page'],
            $data['last_page'],
            $data['from'] ?? null,
            $data['to'] ?? null
        );
    }

    // Getters
    public function getData(): array
    {
        return $this->data;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getLastPage(): int
    {
        return $this->lastPage;
    }

    public function getFrom(): ?int
    {
        return $this->from;
    }

    public function getTo(): ?int
    {
        return $this->to;
    }

    public function toArray(): array
    {
        $result = [
            'data' => array_map(fn($item) => $item->toArray(), $this->data),
            'total' => $this->total,
            'per_page' => $this->perPage,
            'current_page' => $this->currentPage,
            'last_page' => $this->lastPage,
        ];

        if ($this->from !== null) {
            $result['from'] = $this->from;
        }
        if ($this->to !== null) {
            $result['to'] = $this->to;
        }

        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}