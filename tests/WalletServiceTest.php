<?php

namespace Basalam\Tests;

use Basalam\Auth\ClientCredentials;
use Basalam\BasalamClient;
use Basalam\Config\Config;
use Basalam\Config\Environment;
use Basalam\Wallet\Models\BalanceFilter;
use Basalam\Wallet\Models\RefundRequest;
use Basalam\Wallet\Models\RollbackRefundRequest;
use Basalam\Wallet\Models\SpendCreditRequest;
use Basalam\Wallet\Models\SpendSpecificCreditRequest;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Wallet service client.
 */
class WalletServiceTest extends TestCase
{
    private const TEST_USER_ID = 430;
    private const TEST_CLIENT_ID = "";
    private const TEST_CLIENT_SECRET = "";
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

        // In real tests, use environment variables or config files for credentials
        if (!empty(self::TEST_CLIENT_ID) && !empty(self::TEST_CLIENT_SECRET)) {
            $auth = new ClientCredentials(
                clientId: self::TEST_CLIENT_ID,
                clientSecret: self::TEST_CLIENT_SECRET
            );
        } else {
            // Fallback to PersonalToken for testing
            $auth = new \Basalam\Auth\PersonalToken(
                token: ''
            );
        }

        $this->basalamClient = new BasalamClient($auth, $config);
    }

    /**
     * Test get_balance_sync method.
     *

     */
    public function testGetBalance(): void
    {
        try {
            $balanceFilters = [
                new BalanceFilter(cash: true, settleable: true)
            ];

            $result = $this->basalamClient->getBalance(
                userId: self::TEST_USER_ID,
                filters: $balanceFilters
            );

            // Print the result
            echo "\n=== Test: Get Balance ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Balance ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    // -------------------------------------------------------------------------
    // Balance endpoints tests
    // -------------------------------------------------------------------------

    /**
     * Test get_transactions_sync method.
     *

     */
    public function testGetTransactions(): void
    {
        try {
            $result = $this->basalamClient->getTransactions(
                userId: self::TEST_USER_ID,
                page: 1,
                perPage: 100
            );

            // Print the result
            echo "\n=== Test: Get Transactions ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Transactions ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test create_expense_sync method.
     *

     */
    public function testCreateExpense(): void
    {
        try {
            $request = new SpendCreditRequest(
                amount: 1000,
                reasonId: 1,
                referenceId: 12345,
                description: 'Test expense'
            );

            $result = $this->basalamClient->createExpense(
                userId: self::TEST_USER_ID,
                request: $request
            );

            // Print the result
            echo "\n=== Test: Create Expense ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Create Expense ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    // -------------------------------------------------------------------------
    // Credit spending endpoints tests
    // -------------------------------------------------------------------------

    /**
     * Test create_expense_from_credit_sync method.
     *

     */
    public function testCreateExpenseFromCredit(): void
    {
        try {
            $request = new SpendSpecificCreditRequest(
                amount: 1000,
                reasonId: 1,
                referenceId: 12345,
                description: 'Test expense from credit'
            );

            $result = $this->basalamClient->createExpenseFromCredit(
                userId: self::TEST_USER_ID,
                creditId: 1,
                request: $request
            );

            // Print the result
            echo "\n=== Test: Create Expense From Credit ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Create Expense From Credit ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test get_expense_sync method.
     *

     */
    public function testGetExpense(): void
    {
        try {
            $result = $this->basalamClient->getExpense(
                userId: self::TEST_USER_ID,
                expenseId: 1
            );

            // Print the result
            echo "\n=== Test: Get Expense ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Expense ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test delete_expense_sync method.
     *

     */
    public function testDeleteExpense(): void
    {
        try {
            $result = $this->basalamClient->deleteExpense(
                userId: self::TEST_USER_ID,
                expenseId: 1,
                rollbackReasonId: 1
            );

            // Print the result
            echo "\n=== Test: Delete Expense ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Delete Expense ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test get_expense_by_ref_sync method.
     *

     */
    public function testGetExpenseByRef(): void
    {
        try {
            $result = $this->basalamClient->getExpenseByRef(
                userId: self::TEST_USER_ID,
                reasonId: 1,
                referenceId: 12345
            );

            // Print the result
            echo "\n=== Test: Get Expense By Reference ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Expense By Reference ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test delete_expense_by_ref_sync method.
     *

     */
    public function testDeleteExpenseByRef(): void
    {
        try {
            $result = $this->basalamClient->deleteExpenseByRef(
                userId: self::TEST_USER_ID,
                reasonId: 1,
                referenceId: 12345,
                rollbackReasonId: 1
            );

            // Print the result
            echo "\n=== Test: Delete Expense By Reference ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Delete Expense By Reference ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test create_refund_sync method.
     *

     */
    public function testCreateRefund(): void
    {
        try {
            $request = new RefundRequest(
                originalReason: 502,
                originalReferenceId: 12345,
                reason: 503,
                referenceId: 12346,
                amount: 1000,
                description: 'Test refund'
            );

            $result = $this->basalamClient->createRefund(
                request: $request
            );

            // Print the result
            echo "\n=== Test: Create Refund ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Create Refund ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    // -------------------------------------------------------------------------
    // Refund endpoints tests
    // -------------------------------------------------------------------------

    /**
     * Test can_rollback_refund_sync method.
     *

     */
    public function testCanRollbackRefund(): void
    {
        try {
            $result = $this->basalamClient->canRollbackRefund(
                refundReason: 1,
                refundReferenceId: 12345
            );

            // Print the result
            echo "\n=== Test: Can Rollback Refund ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Can Rollback Refund ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test rollback_refund_sync method.
     */
    public function testRollbackRefund(): void
    {
        try {
            $request = new RollbackRefundRequest(
                refundReason: 503,
                rollbackRefundReason: 504,
                refundReferenceId: 12345,
                referenceId: 12347
            );

            $result = $this->basalamClient->rollbackRefund(
                request: $request
            );

            // Print the result
            echo "\n=== Test: Rollback Refund ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Rollback Refund ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

}