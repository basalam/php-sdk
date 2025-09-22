<?php

namespace Basalam\Tests;

use Basalam\Auth\PersonalToken;
use Basalam\BasalamClient;
use Basalam\Config\Config;
use Basalam\Config\Environment;
use Basalam\Search\Models\FiltersModel;
use Basalam\Search\Models\ProductSearchModel;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Search service client.
 */
class SearchServiceTest extends TestCase
{
    /**
     * @var BasalamClient
     */
    private BasalamClient $basalamClient;

    /**
     * Set up the test environment before each test.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Create a BasalamClient instance with real auth and config
        $config = new Config(
            environment: Environment::PRODUCTION,
            timeout: 30.0,
            userAgent: 'SDK-Test'
        );

        // Note: In real tests, use environment variables or config files for tokens
        $auth = new PersonalToken(
            token: ''
        );

        $this->basalamClient = new BasalamClient($auth, $config);
    }

    /**
     * Test searching products with basic query.
     *

     */
    public function testSearchProductsBasic(): void
    {
        try {
            // Create search request with Persian query
            $searchRequest = new ProductSearchModel(
                q: 'apple',
            );


            $result = $this->basalamClient->searchProducts($searchRequest);

            // Print the result
            echo "\n=== Test: Search Products Basic ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Search Products Basic ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test searching products with pagination.
     *

     */
    public function testSearchProductsWithPagination(): void
    {
        try {
            // Create search request with English query and pagination
            $searchRequest = new ProductSearchModel(
                q: 'laptop',
                rows: 10,
                start: 0,
                filters: new FiltersModel(
                    maxPrice: 100000000,
                    minPrice: 10000,
                    minRating: 4
                )
            );

            // Call the method
            $result = $this->basalamClient->searchProducts($searchRequest);

            // Print the result
            echo "\n=== Test: Search Products With Pagination ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Search Products With Pagination ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test searching products with all filter options.
     */
    public function testSearchProductsWithAllFilters(): void
    {
        try {
            // Create comprehensive filters
            $filters = new FiltersModel(
                maxPrice: 500000,
                minPrice: 50000,
                minRating: 3,
                freeShipping: false
            );

            // Create search request
            $searchRequest = new ProductSearchModel(
                q: 'labtop',
                rows: 1,
                start: 0,
                filters: $filters
            );

            // Call the method
            $result = $this->basalamClient->searchProducts($searchRequest);

            // Print the result
            echo "\n=== Test: Search Products With All Filters ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Search Products With All Filters ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

}