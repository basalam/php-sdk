<?php

namespace Basalam\Shipping\Models;

/**
 * ProfileListPaginationResponse model.
 */
class ProfileListPaginationResponse implements \JsonSerializable
{
    private array $data;
    private int $totalCount;
    private int $totalPage;
    private int $resultCount;
    private int $page;
    private int $perPage;
    private bool $isImmediate;

    public function __construct(
        array $data,
        int $totalCount,
        int $totalPage,
        int $resultCount,
        int $page,
        int $perPage,
        bool $isImmediate
    ) {
        $this->data = $data;
        $this->totalCount = $totalCount;
        $this->totalPage = $totalPage;
        $this->resultCount = $resultCount;
        $this->page = $page;
        $this->perPage = $perPage;
        $this->isImmediate = $isImmediate;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn($item) => ProfileResponse::fromArray($item), $data['data'] ?? []),
            $data['total_count'],
            $data['total_page'],
            $data['result_count'],
            $data['page'],
            $data['per_page'],
            $data['is_immediate']
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['data'] = array_map(fn($item) => $item->toArray(), $this->data);
        $result['total_count'] = $this->totalCount;
        $result['total_page'] = $this->totalPage;
        $result['result_count'] = $this->resultCount;
        $result['page'] = $this->page;
        $result['per_page'] = $this->perPage;
        $result['is_immediate'] = $this->isImmediate;
        return $result;
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    public function getTotalPage(): int
    {
        return $this->totalPage;
    }

    public function getResultCount(): int
    {
        return $this->resultCount;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getIsImmediate(): bool
    {
        return $this->isImmediate;
    }
}
