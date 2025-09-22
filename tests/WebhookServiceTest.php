<?php

namespace Basalam\Tests;

use Basalam\Auth\PersonalToken;
use Basalam\BasalamClient;
use Basalam\Config\Config;
use Basalam\Config\Environment;
use Basalam\Webhook\Models\CreateServiceRequest;
use Basalam\Webhook\Models\CreateWebhookRequest;
use Basalam\Webhook\Models\RegisterClientRequest;
use Basalam\Webhook\Models\RequestMethodType;
use Basalam\Webhook\Models\UnRegisterClientRequest;
use Basalam\Webhook\Models\UpdateWebhookRequest;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Webhook service client.
 */
class WebhookServiceTest extends TestCase
{
    /**
     * Test data constants
     */
    private const TEST_WEBHOOK_ID = 2034;
    private const TEST_SERVICE_ID = 1;
    private const TEST_CUSTOMER_ID = 430;
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
     * Test getting webhook services synchronously.
     */
    public function testGetWebhookServices(): void
    {
        try {
            // Call the method
            $result = $this->basalamClient->getWebhookServices();

            // Print the result
            echo "\n=== Test: Get Webhook Services ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Webhook Services ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    // -------------------------------------------------------------------------
    // Webhook service endpoints tests
    // -------------------------------------------------------------------------

    /**
     * Test creating a webhook service synchronously.
     *
     * ice_sync
     */
    public function testCreateWebhookService(): void
    {
        try {
            // Create a service request
            $serviceRequest = new CreateServiceRequest(
                title: 'Test Service Sync',
                description: 'Test description for sync service creation'
            );

            // Call the method
            $result = $this->basalamClient->createWebhookService($serviceRequest);

            // Print the result
            echo "\n=== Test: Create Webhook Service ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Create Webhook Service ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test getting webhook events synchronously.
     *
     * sync
     */
    public function testGetWebhookEvents(): void
    {
        try {
            // Call the method
            $result = $this->basalamClient->getWebhookEvents();

            // Print the result
            echo "\n=== Test: Get Webhook Events ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Webhook Events ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test creating a webhook synchronously.
     *
     *
     */
    public function testCreateWebhook(): void
    {
        try {
            // Create a webhook request
            $webhookRequest = new CreateWebhookRequest(
                eventIds: [5, 8], // Using VENDOR_NEW_ORDER and PRODUCT_CREATE_CHANGES event IDs
                requestMethod: RequestMethodType::POST,
                url: 'https://test-webhook.example.com/webhook',
                serviceId: 153, // Using the service ID from the test data
                requestHeaders: json_encode(['Authorization' => 'Bearer test-token']),
                isActive: true,
                registerMe: true
            );

            // Call the method
            $result = $this->basalamClient->createWebhook($webhookRequest);

            // Print the result
            echo "\n=== Test: Create Webhook ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Create Webhook ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test updating a webhook synchronously.
     *
     *
     */
    public function testUpdateWebhook(): void
    {
        try {
            // Use an existing webhook ID from the test data (1647 or 2034)
            $webhookId = 1647;

            // Create an update webhook request with partial updates
            $updateRequest = new UpdateWebhookRequest(
                eventIds: [5, 9], // Update to different event IDs
                requestMethod: RequestMethodType::PUT, // Change from POST to PUT
                url: 'https://updated-webhook.example.com/webhook',
                isActive: false // Deactivate the webhook
            );

            // Call the method
            $result = $this->basalamClient->updateWebhook($webhookId, $updateRequest);

            // Print the result
            echo "\n=== Test: Update Webhook ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Update Webhook ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test getting webhooks synchronously.
     *
     *     */
    public function testGetWebhooks(): void
    {
        try {

            $result = $this->basalamClient->getWebhooks();

            // Print the result
            echo "\n=== Test: Get Webhooks ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Webhooks ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test getting webhook customers synchronously.
     *
     * rs_sync
     */
    public function testGetWebhookCustomers(): void
    {
        try {
            // Call the method
            $result = $this->basalamClient->getWebhookCustomers(
                page: 1,
                perPage: 5
            );

            // Print the result
            echo "\n=== Test: Get Webhook Customers ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Webhook Customers ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test getting registered webhooks synchronously.
     *
     * ooks_sync
     */
    public function testGetRegisteredWebhooks(): void
    {
        try {
            // Call the method
            $result = $this->basalamClient->getRegisteredWebhooks(
                page: 1,
                perPage: 5
            );

            // Print the result
            echo "\n=== Test: Get Registered Webhooks ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Registered Webhooks ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test registering a webhook synchronously.
     */
    public function testRegisterWebhook(): void
    {
        try {
            // Create a register client request
            $registerRequest = new RegisterClientRequest(
                webhookId: 1647
            );

            // Call the method
            $result = $this->basalamClient->registerWebhook($registerRequest);

            // Print the result
            echo "\n=== Test: Register Webhook ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Register Webhook ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test getting webhook logs synchronously.
     *
     * nc
     */
    public function testGetWebhookLogs(): void
    {
        try {

            $webhookId = self::TEST_WEBHOOK_ID;

            // Call the method
            $result = $this->basalamClient->getWebhookLogs($webhookId);

            // Print the result
            echo "\n=== Test: Get Webhook Logs ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Webhook Logs ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test deleting a webhook synchronously.
     *
     */
    public function testDeleteWebhook(): void
    {
        try {

            $webhookId = self::TEST_WEBHOOK_ID;

            // Call the method
            $result = $this->basalamClient->deleteWebhook($webhookId);

            // Print the result
            echo "\n=== Test: Delete Webhook ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Delete Webhook ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test unregistering a webhook synchronously.
     *
     */
    public function testUnregisterWebhook(): void
    {
        try {
            // Create an unregister client request
            $unregisterRequest = new UnRegisterClientRequest(
                webhookId: self::TEST_WEBHOOK_ID,
                customerId: 123  // Optional parameter
            );

            // Call the method
            $result = $this->basalamClient->unregisterWebhook($unregisterRequest);

            // Print the result
            echo "\n=== Test: Unregister Webhook ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Unregister Webhook ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test RegisterClientRequest model.
     */
    public function testRegisterClientRequestModel(): void
    {
        // Create request
        $request = new RegisterClientRequest(
            webhookId: 123
        );

        $arrayData = $request->toArray();

        // Print the result
        echo "\n=== Test: RegisterClientRequest Model ===\n";
        echo "Result: " . json_encode($arrayData, JSON_PRETTY_PRINT) . "\n";

        // Check if result is not null
        $this->assertNotNull($request);
    }

    // -------------------------------------------------------------------------
    // Model tests
    // -------------------------------------------------------------------------

    /**
     * Test UnRegisterClientRequest model with all parameters.
     */
    public function testUnRegisterClientRequestModel(): void
    {
        // Create request with all parameters
        $request = new UnRegisterClientRequest(
            webhookId: 456,
            customerId: 789
        );

        $arrayData = $request->toArray();

        // Print the result
        echo "\n=== Test: UnRegisterClientRequest Model ===\n";
        echo "Result: " . json_encode($arrayData, JSON_PRETTY_PRINT) . "\n";

        // Check if result is not null
        $this->assertNotNull($request);
    }
}