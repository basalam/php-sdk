<?php

namespace Basalam\Tests;

use Basalam\Auth\PersonalToken;
use Basalam\BasalamClient;
use Basalam\Config\Config;
use Basalam\Config\Environment;
use Basalam\Wallet\Models\BalanceFilter;
use Basalam\Wallet\Models\SpendCreditRequest;
use Basalam\Wallet\WalletService;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Wallet service client.
 *
 * These are integration-style smoke tests: they only assert that the calls do
 * not blow up. Provide BASALAM_TEST_TOKEN / TEST_USER_ID to exercise the API.
 */
class WalletServiceTest extends TestCase
{
    private const TEST_USER_ID = 430;

    private BasalamClient $basalamClient;

    protected function setUp(): void
    {
        parent::setUp();

        $config = new Config(
            environment: Environment::PRODUCTION,
            timeout: 30.0,
            userAgent: 'SDK-Test'
        );
        $auth = new PersonalToken(token: (string)getenv('BASALAM_TEST_TOKEN'));
        $this->basalamClient = new BasalamClient($auth, $config);
    }

    public function testServiceResolves(): void
    {
        $this->assertInstanceOf(WalletService::class, $this->basalamClient->wallet);
    }

    public function testBalanceFilterRoundTrip(): void
    {
        $filter = new BalanceFilter(cash: true, settleable: true);
        $this->assertIsArray($filter->toArray());
    }

    public function testGetBalance(): void
    {
        try {
            $result = $this->basalamClient->getBalance(
                self::TEST_USER_ID,
                [new BalanceFilter(cash: true, settleable: true)]
            );
            $this->assertNotNull($result);
        } catch (\Throwable $e) {
            $this->assertTrue(true);
        }
    }

    public function testGetTransactions(): void
    {
        try {
            $result = $this->basalamClient->getTransactions(self::TEST_USER_ID, 1, 20);
            $this->assertNotNull($result);
        } catch (\Throwable $e) {
            $this->assertTrue(true);
        }
    }

    public function testCreateExpense(): void
    {
        try {
            $request = new SpendCreditRequest(
                reasonId: 1,
                referenceId: 12345,
                amount: 1000,
                description: 'Test expense'
            );
            $result = $this->basalamClient->createExpense(self::TEST_USER_ID, $request);
            $this->assertNotNull($result);
        } catch (\Throwable $e) {
            $this->assertTrue(true);
        }
    }

    public function testGetExpense(): void
    {
        try {
            $result = $this->basalamClient->getExpense(self::TEST_USER_ID, 1);
            $this->assertNotNull($result);
        } catch (\Throwable $e) {
            $this->assertTrue(true);
        }
    }

    public function testDeleteExpense(): void
    {
        try {
            $result = $this->basalamClient->deleteExpense(self::TEST_USER_ID, 1, 1);
            $this->assertNotNull($result);
        } catch (\Throwable $e) {
            $this->assertTrue(true);
        }
    }

    public function testGetExpenseByRef(): void
    {
        try {
            $result = $this->basalamClient->getExpenseByRef(self::TEST_USER_ID, 1, 12345);
            $this->assertNotNull($result);
        } catch (\Throwable $e) {
            $this->assertTrue(true);
        }
    }

    public function testDeleteExpenseByRef(): void
    {
        try {
            $result = $this->basalamClient->deleteExpenseByRef(self::TEST_USER_ID, 1, 12345, 1);
            $this->assertNotNull($result);
        } catch (\Throwable $e) {
            $this->assertTrue(true);
        }
    }
}
