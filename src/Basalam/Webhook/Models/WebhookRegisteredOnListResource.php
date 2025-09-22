<?php

namespace Basalam\Webhook\Models;

/**
 * Response model for list of webhook registrations.
 */
class WebhookRegisteredOnListResource implements \JsonSerializable
{
    private ?array $data;
    private ?int $resultCount;
    private ?int $totalCount;
    private ?int $totalPage;
    private ?int $page;
    private ?int $perPage;

    public function __construct(
        ?array $data = null,
        ?int   $resultCount = null,
        ?int   $totalCount = null,
        ?int   $totalPage = null,
        ?int   $page = null,
        ?int   $perPage = null
    )
    {
        $this->data = $data;
        $this->resultCount = $resultCount;
        $this->totalCount = $totalCount;
        $this->totalPage = $totalPage;
        $this->page = $page;
        $this->perPage = $perPage;
    }

    public static function fromArray(array $data): self
    {
        $registrations = null;
        if (isset($data['data'])) {
            $registrations = array_map(fn($item) => WebhookRegisteredOnResource::fromArray($item), $data['data']);
        }

        return new self(
            $registrations,
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

    // Getters

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