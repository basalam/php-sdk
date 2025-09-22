<?php

namespace Basalam\Search\Models;

/**
 * Product search request model
 */
class ProductSearchModel
{
    private ?FiltersModel $filters;
    private ?string $q;
    private ?int $rows;
    private ?int $start;

    public function __construct(
        ?FiltersModel $filters = null,
        ?string       $q = null,
        ?int          $rows = null,
        ?int          $start = null
    )
    {
        $this->filters = $filters;
        $this->q = $q;
        $this->rows = $rows;
        $this->start = $start;
    }

    /**
     * Create from array
     *
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $filters = null;
        if (isset($data['filters'])) {
            $filters = FiltersModel::fromArray($data['filters']);
        }

        return new self(
            $filters,
            $data['q'] ?? null,
            $data['rows'] ?? null,
            $data['start'] ?? null
        );
    }

    /**
     * Helper method to create a simple text search
     *
     * @param string $query
     * @param int $rows
     * @param int $start
     * @return self
     */
    public static function createSimpleSearch(string $query, int $rows = 20, int $start = 0): self
    {
        return new self(null, $query, $rows, $start);
    }

    // Getters

    /**
     * Helper method to create a filtered search
     *
     * @param FiltersModel $filters
     * @param string|null $query
     * @param int $rows
     * @param int $start
     * @return self
     */
    public static function createFilteredSearch(
        FiltersModel $filters,
        ?string      $query = null,
        int          $rows = 20,
        int          $start = 0
    ): self
    {
        return new self($filters, $query, $rows, $start);
    }

    /**
     * Convert to array for API request
     *
     * @return array
     */
    public function toArray(): array
    {
        $result = [];

        if ($this->filters !== null) {
            $result['filters'] = $this->filters->toArray();
        }
        if ($this->q !== null) {
            $result['q'] = $this->q;
        }
        if ($this->rows !== null) {
            $result['rows'] = $this->rows;
        }
        if ($this->start !== null) {
            $result['start'] = $this->start;
        }

        return $result;
    }

    public function getFilters(): ?FiltersModel
    {
        return $this->filters;
    }

    public function setFilters(?FiltersModel $filters): self
    {
        $this->filters = $filters;
        return $this;
    }

    // Setters with fluent interface

    public function getQ(): ?string
    {
        return $this->q;
    }

    public function setQ(?string $q): self
    {
        $this->q = $q;
        return $this;
    }

    public function getRows(): ?int
    {
        return $this->rows;
    }

    public function setRows(?int $rows): self
    {
        $this->rows = $rows;
        return $this;
    }

    public function getStart(): ?int
    {
        return $this->start;
    }

    public function setStart(?int $start): self
    {
        $this->start = $start;
        return $this;
    }

    /**
     * Helper method to set search query
     * Alias for setQ for better readability
     *
     * @param string $query
     * @return self
     */
    public function setSearchQuery(string $query): self
    {
        return $this->setQ($query);
    }

    /**
     * Helper method to set pagination
     *
     * @param int $page Page number (1-based)
     * @param int $perPage Items per page
     * @return self
     */
    public function setPagination(int $page, int $perPage): self
    {
        $this->rows = $perPage;
        $this->start = ($page - 1) * $perPage;
        return $this;
    }
}