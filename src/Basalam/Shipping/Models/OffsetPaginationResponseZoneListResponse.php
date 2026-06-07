<?php

namespace Basalam\Shipping\Models;

/**
 * OffsetPaginationResponseZoneListResponse model.
 */
class OffsetPaginationResponseZoneListResponse implements \JsonSerializable
{
    private array $data;
    private int $totalCount;
    private int $totalPage;
    private int $page;
    private int $resultCount;
    private int $perPage;

    public function __construct(
        array $data,
        int $totalCount,
        int $totalPage,
        int $page,
        int $resultCount,
        int $perPage
    ) {
        $this->data = $data;
        $this->totalCount = $totalCount;
        $this->totalPage = $totalPage;
        $this->page = $page;
        $this->resultCount = $resultCount;
        $this->perPage = $perPage;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            array_map(fn($item) => ZoneListResponse::fromArray($item), $data['data'] ?? []),
            $data['total_count'],
            $data['total_page'],
            $data['page'],
            $data['result_count'],
            $data['per_page']
        );
    }

    public function toArray(): array
    {
        $result = [];
        $result['data'] = array_map(fn($item) => $item->toArray(), $this->data);
        $result['total_count'] = $this->totalCount;
        $result['total_page'] = $this->totalPage;
        $result['page'] = $this->page;
        $result['result_count'] = $this->resultCount;
        $result['per_page'] = $this->perPage;
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

    public function getPage(): int
    {
        return $this->page;
    }

    public function getResultCount(): int
    {
        return $this->resultCount;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }
}
