# Search Service

Search for products and entities with the Search Service. This service provides powerful search capabilities: search for
products with advanced filters, apply price ranges and category filters, sort results by various criteria, paginate
through search results, and get detailed product information.

## Table of Contents

- [Search Methods](#search-methods)
- [Examples](#examples)

## Search Methods

### Methods

| Method                                         | Description         | Parameters |
|------------------------------------------------|---------------------|------------|
| [`searchProducts()`](#search-products-example) | Search for products | `request`  |

## Examples

### Basic Setup

```php
use Basalam\BasalamClient;
use Basalam\Auth\PersonalToken;
use Basalam\Search\Models\ProductSearchModel;
use Basalam\Search\Models\FiltersModel;

$auth = new PersonalToken(
    token: "your_access_token",
    refreshToken: "your_refresh_token"
);
$client = new BasalamClient(auth: $auth);
```

### Search Products Example

```php
function searchProductsExample()
{
    global $client;
    
    $results = $client->searchProducts(
        request: new ProductSearchModel([
            'filters' => new FiltersModel([
                'freeShipping' => 1,
                'slug' => "electronics",
                'vendorIdentifier' => "vendor123",
                'maxPrice' => 500000,
                'minPrice' => 100000,
                'sameCity' => 1,
                'minRating' => 4,
                'vendorScore' => 80
            ]),
            'q' => "laptop",
            'rows' => 20,
            'start' => 0
        ])
    );
    
    echo "Search results: {$results}\n";
    return $results;
}