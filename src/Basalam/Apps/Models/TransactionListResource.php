<?php

namespace Basalam\Apps\Models;

/**
 * TransactionListResource model.
 */
class TransactionListResource implements \JsonSerializable
{
    private ?array $data;
    private ?int $resultCount;
    private ?int $totalCount;
    private ?int $totalPage;
    private ?int $page;
    private ?int $perPage;

    public function __construct(
        ?array $data,
        ?int $resultCount,
        ?int $totalCount,
        ?int $totalPage,
        ?int $page,
        ?int $perPage
    ) {
        $this->data = $data;
        $this->resultCount = $resultCount;
        $this->totalCount = $totalCount;
        $this->totalPage = $totalPage;
        $this->page = $page;
        $this->perPage = $perPage;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['data']) ? array_map(fn($item) => TransactionResource::fromArray($item), $data['data']) : null,
            $data['result_count'] ?? null,
            $data['total_count'] ?? null,
            $data['total_page'] ?? null,
            $data['page'] ?? null,
            $data['per_page'] ?? null
        );
    }

    public function toArray(): array
    {
        $result = [];
        if ($this->data !== null) {
            $result['data'] = array_map(fn($item) => $item->toArray(), $this->data);
        }
        if ($this->resultCount !== null) {
            $result['result_count'] = $this->resultCount;
        }
        if ($this->totalCount !== null) {
            $result['total_count'] = $this->totalCount;
        }
        if ($this->totalPage !== null) {
            $result['total_page'] = $this->totalPage;
        }
        if ($this->page !== null) {
            $result['page'] = $this->page;
        }
        if ($this->perPage !== null) {
            $result['per_page'] = $this->perPage;
        }
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function getResultCount(): ?int
    {
        return $this->resultCount;
    }

    public function getTotalCount(): ?int
    {
        return $this->totalCount;
    }

    public function getTotalPage(): ?int
    {
        return $this->totalPage;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function getPerPage(): ?int
    {
        return $this->perPage;
    }
}
