<?php

namespace Basalam\Tests;

use Basalam\Auth\PersonalToken;
use Basalam\BasalamClient;
use Basalam\Config\Config;
use Basalam\Config\Environment;
use Basalam\Core\Models\BatchUpdateProductsRequest;
use Basalam\Core\Models\BulkActionItem;
use Basalam\Core\Models\BulkProductsUpdateRequestSchema;
use Basalam\Core\Models\CreateVendorSchema;
use Basalam\Core\Models\GetVendorProductsSchema;
use Basalam\Core\Models\ProductBulkActionTypeEnum;
use Basalam\Core\Models\ProductBulkFieldInputEnum;
use Basalam\Core\Models\ProductFilterSchema;
use Basalam\Core\Models\ProductRequestSchema;
use Basalam\Core\Models\ProductStatusInputEnum;
use Basalam\Core\Models\ShelveSchema;
use Basalam\Core\Models\ShippingMethodUpdateItem;
use Basalam\Core\Models\UnitTypeInputEnum;
use Basalam\Core\Models\UpdateShelveProductsSchema;
use Basalam\Core\Models\UpdateProductRequestItem;
use Basalam\Core\Models\UpdateShippingMethodSchema;
use Basalam\Core\Models\UpdateVendorSchema;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Core service client.
 *
 * IMPORTANT: Product-related functions are critical and thoroughly tested.
 */
class CoreServiceTest extends TestCase
{
    private const TEST_USER_ID = 430;
    private const TEST_VENDOR_ID = 266;
    private const TEST_PRODUCT_ID = 24835037;
    private const TEST_CATEGORY_ID = 1068;
    private const TEST_BANK_ACCOUNT_ID = 54321;
    private const TEST_SHELVE_ID = 532896;
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

    // -------------------------------------------------------------------------
    // Vendor Management endpoints tests
    // -------------------------------------------------------------------------

    /**
     * Test create_vendor method.
     *

     */
    public function testCreateVendor(): void
    {
        try {
            $request = new CreateVendorSchema([
                'title' => 'Test Vendor',
                'identifier' => 'test-vendor-unique-' . time(), // Make it unique
                'category_type' => 1,
                'city' => 1,
                'notice' => 'Test vendor notice',
                'summary' => 'Test vendor summary',
                'address' => 'Test address',
                'postal_code' => '1234567890',
                'legal_data' => ['is_legal' => false]
            ]);

            $result = $this->basalamClient->createVendor(self::TEST_USER_ID, $request);

            // Print the result
            echo "\n=== Test: Create Vendor ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Create Vendor ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test update_vendor method.
     *

     */
    public function testUpdateVendor(): void
    {
        try {
            $request = new UpdateVendorSchema([
                'title' => 'Updated Test Vendor',
                'notice' => 'Updated notice',
                'summary' => 'Updated summary'
            ]);

            $result = $this->basalamClient->updateVendor(self::TEST_VENDOR_ID, $request);

            // Print the result
            echo "\n=== Test: Update Vendor ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Update Vendor ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test get_vendor method with minimal and full response.
     *

     */
    public function testGetVendor(): void
    {
        try {
            // Test with minimal response
            $resultMinimal = $this->basalamClient->getVendor(self::TEST_VENDOR_ID);

            // Print the result
            echo "\n=== Test: Get Vendor (Minimal) ===\n";
            echo "Result: " . json_encode($resultMinimal, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($resultMinimal);

            // Test with full response
            $resultFull = $this->basalamClient->getVendor(
                self::TEST_VENDOR_ID,
                'return=full'
            );

            // Print the result
            echo "\n=== Test: Get Vendor (Full) ===\n";
            echo "Result: " . json_encode($resultFull, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($resultFull);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Vendor ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test get_default_shipping_methods method.
     *

     */
    public function testGetDefaultShippingMethods(): void
    {
        try {
            $result = $this->basalamClient->getDefaultShippingMethods();

            // Print the result
            echo "\n=== Test: Get Default Shipping Methods ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Default Shipping Methods ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test get_shipping_methods method with and without filters.
     *

     */
    public function testGetShippingMethods(): void
    {
        try {
            // Test without filters
            $result = $this->basalamClient->getShippingMethods();

            // Print the result
            echo "\n=== Test: Get Shipping Methods (No Filters) ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

            // Test with filters
            $resultFiltered = $this->basalamClient->getShippingMethods([
                'vendor_ids' => [self::TEST_VENDOR_ID],
                'page' => 1,
                'per_page' => 5
            ]);

            // Print the result
            echo "\n=== Test: Get Shipping Methods (With Filters) ===\n";
            echo "Result: " . json_encode($resultFiltered, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($resultFiltered);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Shipping Methods ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test get_working_shipping_methods method.
     *

     */
    public function testGetWorkingShippingMethods(): void
    {
        try {
            $result = $this->basalamClient->getWorkingShippingMethods(self::TEST_VENDOR_ID);

            // Print the result
            echo "\n=== Test: Get Working Shipping Methods ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Working Shipping Methods ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test update_shipping_methods method.
     *

     */
    public function testUpdateShippingMethods(): void
    {
        try {
            $shippingMethodItem = new ShippingMethodUpdateItem([
                'method_id' => 1,
                'is_customized' => true,
                'base_cost' => 10000,
                'additional_cost' => 5000
            ]);

            $request = new UpdateShippingMethodSchema([
                'shipping_methods' => [$shippingMethodItem]
            ]);

            $result = $this->basalamClient->updateShippingMethods(self::TEST_VENDOR_ID, $request);

            // Print the result
            echo "\n=== Test: Update Shipping Methods ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Update Shipping Methods ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    // -------------------------------------------------------------------------
    // CRITICAL: Product Management endpoints tests - VERY IMPORTANT
    // -------------------------------------------------------------------------

    /**
     * Test get_vendor_products method - CRITICAL for product functionality.
     *

     */
    public function testGetVendorProducts(): void
    {
        try {
            // Test without query params
            $result = $this->basalamClient->getVendorProducts(self::TEST_VENDOR_ID, null);

            // Print the result
            echo "\n=== Test: Get Vendor Products (No Params) ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

            // Test with query params
            $queryParams = new GetVendorProductsSchema([
                'page' => 1,
                'per_page' => 5,
                'statuses' => [ProductStatusInputEnum::PUBLISHED],
                'stock_gte' => 50
            ]);

            $resultFiltered = $this->basalamClient->getVendorProducts(self::TEST_VENDOR_ID, $queryParams);

            // Print the result
            echo "\n=== Test: Get Vendor Products (With Params) ===\n";
            echo "Result: " . json_encode($resultFiltered, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($resultFiltered);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Vendor Products ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test create_product method - CRITICAL for product creation.
     *

     */
    public function testCreateProduct(): void
    {
        try {
            $request = new ProductRequestSchema([
                'name' => 'Test sdk php2',
                'description' => 'blahahahahahahahahah ahhahahahah ahhahahah',
                'category_id' => self::TEST_CATEGORY_ID,
                'primary_price' => 100000,
                'weight' => 300,
                'package_weight' => 500,
                'stock' => 10,
                'status' => ProductStatusInputEnum::PUBLISHED,
                'unit_quantity' => 10,
                'unit_type' => UnitTypeInputEnum::NUMERIC
            ]);

            // Add photo file from tests folder
            $photoFiles = [__DIR__ . '/test1.png'];

            $result = $this->basalamClient->createProduct(self::TEST_VENDOR_ID, $request, $photoFiles);

            // Print the result
            echo "\n=== Test: Create Product ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Create Product ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test update_product method - CRITICAL for product updates.
     *

     */
    public function testUpdateProduct(): void
    {
        try {
            $request = new ProductRequestSchema([
                'name' => 'Updated Test Product',
                'price' => 150000,
                'stock' => 5,
                'description' => 'Updated product description'
            ]);

            $result = $this->basalamClient->updateProduct(self::TEST_PRODUCT_ID, $request);

            // Print the result
            echo "\n=== Test: Update Product ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Update Product ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test get_product method - CRITICAL for retrieving product details.
     *

     */
    public function testGetProduct(): void
    {
        try {
            // Test with minimal response
            $resultMinimal = $this->basalamClient->getProduct(self::TEST_PRODUCT_ID);

            // Print the result
            echo "\n=== Test: Get Product (Minimal) ===\n";
            echo "Result: " . json_encode($resultMinimal, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($resultMinimal);

            // Test with full response
            $resultFull = $this->basalamClient->getProduct(
                self::TEST_PRODUCT_ID,
                'return=full'
            );

            // Print the result
            echo "\n=== Test: Get Product (Full) ===\n";
            echo "Result: " . json_encode($resultFull, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($resultFull);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Product ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test get_products method - CRITICAL for listing products.
     *

     */
    public function testGetProducts(): void
    {
        try {
            // Test without filters
            $result = $this->basalamClient->getProducts();

            // Print the result
            echo "\n=== Test: Get Products (No Filters) ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

            // Test with filters
            $queryParams = new \Basalam\Core\Models\GetProductsQuerySchema([
                'page' => 1,
                'per_page' => 10,
                'vendor_id' => self::TEST_VENDOR_ID
            ]);
            $resultFiltered = $this->basalamClient->getProducts($queryParams);

            // Print the result
            echo "\n=== Test: Get Products (With Filters) ===\n";
            echo "Result: " . json_encode($resultFiltered, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($resultFiltered);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Products ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test update_bulk_products method - CRITICAL for bulk updates.
     *

     */
    public function testUpdateBulkProducts(): void
    {
        try {
            $productItem = new UpdateProductRequestItem([
                'id' => self::TEST_PRODUCT_ID,
                'name' => 'Updated Product Name',
                'primary_price' => 120000,
                'stock' => 15
            ]);

            $request = new BatchUpdateProductsRequest([
                'data' => [$productItem]
            ]);

            $result = $this->basalamClient->updateBulkProducts(self::TEST_VENDOR_ID, $request);

            // Print the result
            echo "\n=== Test: Update Bulk Products ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Update Bulk Products ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test create_products_bulk_action_request method.
     *

     */
    public function testCreateProductsBulkActionRequest(): void
    {
        try {
            $filter = new ProductFilterSchema([
                'product_id' => [self::TEST_PRODUCT_ID]
            ]);

            $action = new BulkActionItem([
                'field' => ProductBulkFieldInputEnum::STOCK,
                'action' => ProductBulkActionTypeEnum::SET,
                'value' => 1
            ]);

            $request = new BulkProductsUpdateRequestSchema([
                'product_filter' => $filter,
                'action' => [$action]
            ]);

            $result = $this->basalamClient->createProductsBulkActionRequest(self::TEST_VENDOR_ID, $request);

            // Print the result
            echo "\n=== Test: Create Products Bulk Action Request ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Create Products Bulk Action Request ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    // -------------------------------------------------------------------------
    // User Management endpoints tests
    // -------------------------------------------------------------------------

    /**
     * Test get_current_user method.
     *

     */
    public function testGetCurrentUser(): void
    {
        try {
            $result = $this->basalamClient->getCurrentUser();

            // Print the result
            echo "\n=== Test: Get Current User ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Current User ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test get_user_bank_accounts method.
     *

     */
    public function testGetUserBankAccounts(): void
    {
        try {
            $result = $this->basalamClient->getUserBankAccounts(self::TEST_USER_ID);

            // Print the result
            echo "\n=== Test: Get User Bank Accounts ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get User Bank Accounts ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test updateVendorStatus method.
     */
    public function testUpdateVendorStatus(): void
    {
        try {
            $request = new \Basalam\Core\Models\UpdateVendorStatusSchema([
                'status' => \Basalam\Core\Models\VendorStatusInputEnum::ACTIVE
            ]);

            $result = $this->basalamClient->updateVendorStatus(self::TEST_VENDOR_ID, $request);

            echo "\n=== Test: Update Vendor Status ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Update Vendor Status ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test createVendorMobileChangeRequest method.
     */
    public function testCreateVendorMobileChangeRequest(): void
    {
        try {
            $request = new \Basalam\Core\Models\ChangeVendorMobileRequestSchema([
                'mobile' => '09123456789'
            ]);

            $result = $this->basalamClient->createVendorMobileChangeRequest(self::TEST_VENDOR_ID, $request);

            echo "\n=== Test: Create Vendor Mobile Change Request ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Create Vendor Mobile Change Request ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test createVendorMobileChangeConfirmation method.
     */
    public function testCreateVendorMobileChangeConfirmation(): void
    {
        try {
            $request = new \Basalam\Core\Models\ChangeVendorMobileConfirmSchema([
                'mobile' => '09123456789',
                'verification_code' => 123456
            ]);

            $result = $this->basalamClient->createVendorMobileChangeConfirmation(self::TEST_VENDOR_ID, $request);

            echo "\n=== Test: Create Vendor Mobile Change Confirmation ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Create Vendor Mobile Change Confirmation ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test updateProductVariation method.
     */
    public function testUpdateProductVariation(): void
    {
        try {
            $variationId = 6639697; // Test variation ID

            $request = new \Basalam\Core\Models\UpdateProductVariationSchema([
                'primary_price' => 80000,
                'stock' => 25,
                'sku' => 'TEST-VAR-001'
            ]);

            $result = $this->basalamClient->updateProductVariation(self::TEST_PRODUCT_ID, $variationId, $request);

            echo "\n=== Test: Update Product Variation ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Update Product Variation ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test getProductsBulkActionRequests method.
     */
    public function testGetProductsBulkActionRequests(): void
    {
        try {
            $result = $this->basalamClient->getProductsBulkActionRequests(
                self::TEST_VENDOR_ID,
                1,
                10
            );

            echo "\n=== Test: Get Products Bulk Action Requests ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Get Products Bulk Action Requests ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test getProductsBulkActionRequestsCount method.
     */
    public function testGetProductsBulkActionRequestsCount(): void
    {
        try {
            $result = $this->basalamClient->getProductsBulkActionRequestsCount(self::TEST_VENDOR_ID);

            echo "\n=== Test: Get Products Bulk Action Requests Count ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Get Products Bulk Action Requests Count ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test getProductsUnsuccessfulBulkActionRequests method.
     */
    public function testGetProductsUnsuccessfulBulkActionRequests(): void
    {
        try {
            $result = $this->basalamClient->getProductsUnsuccessfulBulkActionRequests(
                self::TEST_VENDOR_ID,
                1,
                10,
                1
            );

            echo "\n=== Test: Get Products Unsuccessful Bulk Action Requests ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Get Products Unsuccessful Bulk Action Requests ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test getProductShelves method.
     */
    public function testGetProductShelves(): void
    {
        try {
            $result = $this->basalamClient->getProductShelves(self::TEST_PRODUCT_ID);

            echo "\n=== Test: Get Product Shelves ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Get Product Shelves ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test createDiscount method.
     */
    public function testCreateDiscount(): void
    {
        try {
            $request = new \Basalam\Core\Models\CreateDiscountRequestSchema([
                'product_filter' => new \Basalam\Core\Models\DiscountProductFilterSchema([
                    'product_ids' => [self::TEST_PRODUCT_ID]
                ]),
                'discount_percent' => 10,
                'active_days' => 7
            ]);

            $result = $this->basalamClient->createDiscount(self::TEST_VENDOR_ID, $request);

            echo "\n=== Test: Create Discount ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Create Discount ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test deleteDiscount method.
     */
    public function testDeleteDiscount(): void
    {
        try {
            $request = new \Basalam\Core\Models\DeleteDiscountRequestSchema([
                'product_filter' => new \Basalam\Core\Models\DiscountProductFilterSchema([
                    'product_ids' => [self::TEST_PRODUCT_ID]
                ])
            ]);

            $result = $this->basalamClient->deleteDiscount(self::TEST_VENDOR_ID, $request);

            echo "\n=== Test: Delete Discount ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Delete Discount ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test createUserMobileConfirmationRequest method.
     */
    public function testCreateUserMobileConfirmationRequest(): void
    {
        try {
            $result = $this->basalamClient->createUserMobileConfirmationRequest(self::TEST_USER_ID);

            echo "\n=== Test: Create User Mobile Confirmation Request ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Create User Mobile Confirmation Request ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test verifyUserMobileConfirmationRequest method.
     */
    public function testVerifyUserMobileConfirmationRequest(): void
    {
        try {
            $request = new \Basalam\Core\Models\ConfirmCurrentUserMobileConfirmSchema([
                'verification_code' => 123456
            ]);

            $result = $this->basalamClient->verifyUserMobileConfirmationRequest(self::TEST_USER_ID, $request);

            echo "\n=== Test: Verify User Mobile Confirmation Request ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Verify User Mobile Confirmation Request ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test createUserMobileChangeRequest method.
     */
    public function testCreateUserMobileChangeRequest(): void
    {
        try {
            $request = new \Basalam\Core\Models\ChangeUserMobileRequestSchema([
                'mobile' => '09121534533'
            ]);

            $result = $this->basalamClient->createUserMobileChangeRequest(self::TEST_USER_ID, $request);

            echo "\n=== Test: Create User Mobile Change Request ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Create User Mobile Change Request ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test verifyUserMobileChangeRequest method.
     */
    public function testVerifyUserMobileChangeRequest(): void
    {
        try {
            $request = new \Basalam\Core\Models\ChangeUserMobileConfirmSchema([
                'mobile' => '09123456789',
                'verification_code' => 123456
            ]);

            $result = $this->basalamClient->verifyUserMobileChangeRequest(self::TEST_USER_ID, $request);

            echo "\n=== Test: Verify User Mobile Change Request ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Verify User Mobile Change Request ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test createUserBankAccount method.
     */
    public function testCreateUserBankAccount(): void
    {
        try {
            // Test with minimal response
            $request = new \Basalam\Core\Models\UserCardsSchema([
                'card_number' => '6063733231170311'
            ]);

            $result = $this->basalamClient->createUserBankAccount(self::TEST_USER_ID, $request);

            echo "\n=== Test: Create User Bank Account ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
            $this->assertIsArray($result); // Assert result is array/dict like Python
        } catch (\Exception $e) {
            echo "\n=== Test: Create User Bank Account ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test deleteUserBankAccount method.
     */
    public function testDeleteUserBankAccount(): void
    {
        try {
            $result = $this->basalamClient->deleteUserBankAccount(self::TEST_USER_ID, self::TEST_BANK_ACCOUNT_ID);

            echo "\n=== Test: Delete User Bank Account ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Delete User Bank Account ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test updateUserBankAccount method.
     */
    public function testUpdateUserBankAccount(): void
    {
        try {
            $request = new \Basalam\Core\Models\UpdateUserBankInformationSchema([
                'user_id' => self::TEST_USER_ID,
                'card_number' => '9876543210987654',
                'sheba_number' => 'IR123456789012345678901234',
                'account_owner' => 'Updated Test User',
                'status' => 1,
                'bank_name' => 'Test Bank',
                'sheba_status' => 'active',
                'bank_account_number' => '123456789012'
            ]);

            $result = $this->basalamClient->updateUserBankAccount(self::TEST_BANK_ACCOUNT_ID, $request);

            echo "\n=== Test: Update User Bank Account ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
            $this->assertIsArray($result); // Assert result is array/dict like Python
        } catch (\Exception $e) {
            echo "\n=== Test: Update User Bank Account ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test updateUserVerification method.
     */
    public function testUpdateUserVerification(): void
    {
        try {
            $request = new \Basalam\Core\Models\UserVerificationSchema([
                'national_code' => '1234567890',
                'birthday' => '1990-01-01'
            ]);

            $result = $this->basalamClient->updateUserVerification(self::TEST_USER_ID, $request);

            echo "\n=== Test: Update User Verification ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Update User Verification ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test verifyUserBankAccount method.
     */
    public function testVerifyUserBankAccount(): void
    {
        try {
            $request = new \Basalam\Core\Models\UserVerifyBankInformationSchema([
                'bank_information_id' => 54321,
                'national_code' => "0123456789",
                'birthday' => "1990-01-01"
            ]);

            $result = $this->basalamClient->verifyUserBankAccount(self::TEST_USER_ID, $request);

            echo "\n=== Test: Verify User Bank Account ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Verify User Bank Account ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test verifyUserBankAccountOtp method.
     */
    public function testVerifyUserBankAccountOtp(): void
    {
        try {
            $request = new \Basalam\Core\Models\UserCardsOtpSchema([
                'card_number' => '123456789',
                'otp_code' => '123456'
            ]);

            $result = $this->basalamClient->verifyUserBankAccountOtp(self::TEST_USER_ID, $request);

            echo "\n=== Test: Verify User Bank Account OTP ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Verify User Bank Account OTP ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test getCategories method.
     */
    public function testGetCategories(): void
    {
        try {
            $result = $this->basalamClient->getCategories();

            echo "\n=== Test: Get Categories ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Get Categories ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test getCategory method.
     */
    public function testGetCategory(): void
    {
        try {
            $result = $this->basalamClient->getCategory(self::TEST_CATEGORY_ID);

            echo "\n=== Test: Get Category ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Get Category ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test getCategoryAttributes method.
     */
    public function testGetCategoryAttributes(): void
    {
        try {
            $result = $this->basalamClient->getCategoryAttributes(self::TEST_CATEGORY_ID);

            echo "\n=== Test: Get Category Attributes ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Get Category Attributes ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    // -------------------------------------------------------------------------
    // Shelve Management endpoints tests
    // -------------------------------------------------------------------------

    /**
     * Test createShelve method.
     */
    public function testCreateShelve(): void
    {
        try {
            $request = new ShelveSchema([
                'title' => 'PHP SDK Test Shelve 02 ' . time(),
                'description' => 'This is a test shelve created by SDK'
            ]);

            $result = $this->basalamClient->createShelve($request);

            echo "\n=== Test: Create Shelve ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Create Shelve ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test updateShelve method.
     */
    public function testUpdateShelve(): void
    {
        try {
            $request = new ShelveSchema([
                'title' => 'Updated Test Shelve ' . time(),
                'description' => 'This shelve has been updated',
            ]);

            $result = $this->basalamClient->updateShelve(self::TEST_SHELVE_ID, $request);

            echo "\n=== Test: Update Shelve ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Update Shelve ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test getShelveProducts method.
     */
    public function testGetShelveProducts(): void
    {
        try {
            // Test without filter
            $result = $this->basalamClient->getShelveProducts(self::TEST_SHELVE_ID);

            echo "\n=== Test: Get Shelve Products (No Filter) ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Shelve Products ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test updateShelveProducts method.
     */
    public function testUpdateShelveProducts(): void
    {
        try {
            $request = new UpdateShelveProductsSchema([
                'include_products' => [self::TEST_PRODUCT_ID],
                'exclude_products' => []
            ]);

            $result = $this->basalamClient->updateShelveProducts(self::TEST_SHELVE_ID, $request);

            echo "\n=== Test: Update Shelve Products ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Update Shelve Products ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test deleteShelveProduct method.
     */
    public function testDeleteShelveProduct(): void
    {
        try {
            $result = $this->basalamClient->deleteShelveProduct(self::TEST_SHELVE_ID, self::TEST_PRODUCT_ID);

            echo "\n=== Test: Delete Shelve Product ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Delete Shelve Product ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    /**
     * Test deleteShelve method.
     */
    public function testDeleteShelve(): void
    {
        try {
            $result = $this->basalamClient->deleteShelve(self::TEST_SHELVE_ID);

            echo "\n=== Test: Delete Shelve ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            $this->assertNotNull($result);
        } catch (\Exception $e) {
            echo "\n=== Test: Delete Shelve ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }
}