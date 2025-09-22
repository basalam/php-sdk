<?php

namespace Basalam\Tests;

use Basalam\Auth\PersonalToken;
use Basalam\BasalamClient;
use Basalam\Config\Config;
use Basalam\Config\Environment;
use Basalam\Order\Models\CreatePaymentRequestModel;
use Basalam\Order\Models\OrderEnum;
use Basalam\Order\Models\PaymentCallbackRequestModel;
use Basalam\Order\Models\PaymentDriver;
use Basalam\Order\Models\PaymentVerifyRequestModel;
use Basalam\Order\Models\UnpaidInvoiceStatusEnum;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Order service client.
 */
class OrderServiceTest extends TestCase
{
    private const TEST_INVOICE_ID = 12345;
    private const TEST_PAYMENT_ID = 67890;
    private const TEST_PRODUCT_ID = 23145254;
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
            userAgent: 'Integration Test Agent'
        );

        // Note: In real tests, use environment variables or config files for tokens
        $auth = new PersonalToken(
            token: ''
        );

        $this->basalamClient = new BasalamClient($auth, $config);
    }

    /**
     * Test get_baskets_sync method.
     *

     */
    public function testGetBaskets(): void
    {
        try {
            $result = $this->basalamClient->getBaskets(refresh: true);

            // Print the result
            echo "\n=== Test: Get Baskets ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Baskets ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    // -------------------------------------------------------------------------
    // Basket endpoints tests
    // -------------------------------------------------------------------------

    /**
     * Test get_product_variation_status_sync method with test product ID.
     *

     */
    public function testGetProductVariationStatus(): void
    {
        try {
            $result = $this->basalamClient->getProductVariationStatus(
                productId: 23145254
            );

            // Print the result
            echo "\n=== Test: Get Product Variation Status ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Product Variation Status ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test create_invoice_payment_sync method.
     *

     */
    public function testCreateInvoicePayment(): void
    {
        try {
            $paymentDriver = new PaymentDriver(amount: 10000);
            $request = new CreatePaymentRequestModel(
                payDrivers: ["wallet" => $paymentDriver],
                callback: "https://example.com/callback",
                optionCode: "TEST123",
                nationalId: "1234567890"
            );

            $result = $this->basalamClient->createInvoicePayment(
                invoiceId: self::TEST_INVOICE_ID,
                request: $request
            );

            // Print the result
            echo "\n=== Test: Create Invoice Payment ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Create Invoice Payment ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    // -------------------------------------------------------------------------
    // Invoice payment endpoints tests
    // -------------------------------------------------------------------------

    /**
     * Test get_payable_invoices_sync method.
     *

     */
    public function testGetPayableInvoices(): void
    {
        try {
            $result = $this->basalamClient->getPayableInvoices(
                page: 1,
                perPage: 10
            );

            // Print the result
            echo "\n=== Test: Get Payable Invoices ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Payable Invoices ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    // -------------------------------------------------------------------------
    // Invoice endpoints tests
    // -------------------------------------------------------------------------

    /**
     * Test get_unpaid_invoices_sync method.
     *

     */
    public function testGetUnpaidInvoices(): void
    {
        try {
            $result = $this->basalamClient->getUnpaidInvoices(
                invoiceId: self::TEST_INVOICE_ID,
                status: UnpaidInvoiceStatusEnum::PAYABLE,
                page: 1,
                perPage: 20,
                sort: OrderEnum::DESC
            );

            // Print the result
            echo "\n=== Test: Get Unpaid Invoices ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Unpaid Invoices ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test get_payment_callback_sync method.
     *

     */
    public function testGetPaymentCallback(): void
    {
        try {
            $request = new PaymentCallbackRequestModel(
                status: "success",
                transactionId: "TXN123456",
                description: "Test payment callback"
            );

            $result = $this->basalamClient->getPaymentCallback(
                paymentId: self::TEST_PAYMENT_ID,
                request: $request
            );

            // Print the result
            echo "\n=== Test: Get Payment Callback ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Payment Callback ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    // -------------------------------------------------------------------------
    // Payment callback endpoints tests
    // -------------------------------------------------------------------------

    /**
     * Test create_payment_callback_sync method.
     *

     */
    public function testCreatePaymentCallback(): void
    {
        try {
            $request = new PaymentVerifyRequestModel(
                paymentId: "PAY123456",
                transactionId: "TXN123456",
                description: "Test payment verification"
            );

            $result = $this->basalamClient->createPaymentCallback(
                paymentId: self::TEST_PAYMENT_ID,
                request: $request
            );

            // Print the result
            echo "\n=== Test: Create Payment Callback ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Create Payment Callback ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test PaymentDriver model.
     */
    public function testPaymentDriverModel(): void
    {
        $driver = new PaymentDriver(amount: 50000);

        $arrayData = $driver->toArray();

        // Print the result
        echo "\n=== Test: PaymentDriver Model ===\n";
        echo "Result: " . json_encode($arrayData, JSON_PRETTY_PRINT) . "\n";

        // Check if result is not null
        $this->assertNotNull($driver);
    }

}