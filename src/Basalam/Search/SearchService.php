<?php

namespace Basalam\Search;

use Basalam\Auth\BaseAuth;
use Basalam\Config\Config;
use Basalam\Http\BaseClient;
use Basalam\Search\Models\ProductSearchModel;

/**
 * Client for the Search service API.
 *
 * This module provides a client for interacting with Basalam's search service.
 */
class SearchService extends BaseClient
{
    public function __construct(BaseAuth $auth, ?Config $config = null)
    {
        parent::__construct($auth, $config, 'search');
    }

    /**
     * Search for products.
     *
     * IMPORTANT: This endpoint does not require authentication.
     * The search service is publicly accessible.
     *
     * @param ProductSearchModel $request The search request model containing filters and search parameters
     * @return array The search results
     */
    public function searchProducts(ProductSearchModel $request): array
    {
        $endpoint = '/v1/products/search';

        // Pass requireAuth=false
        // This endpoint is publicly accessible and doesn't need authentication
        return $this->post(
            path: $endpoint,
            data: $request->toArray(),
            files: [],
            headers: [],
            requireAuth: false
        );
    }
}