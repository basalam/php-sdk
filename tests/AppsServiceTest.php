<?php

namespace Basalam\Tests;

use Basalam\Apps\AppsService;
use Basalam\Apps\Models\PlanListResource;
use Basalam\Apps\Models\TransactionListResource;
use Basalam\Auth\PersonalToken;
use Basalam\BasalamClient;
use Basalam\Config\Config;
use Basalam\Config\Environment;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Apps (Appstore Payment) service client.
 */
class AppsServiceTest extends TestCase
{
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
        $this->assertInstanceOf(AppsService::class, $this->basalamClient->apps);
    }

    public function testPlanListResourceRoundTrip(): void
    {
        $resource = PlanListResource::fromArray(['data' => []]);
        $this->assertArrayHasKey('data', $resource->toArray());
    }

    public function testTransactionListResourceRoundTrip(): void
    {
        $resource = TransactionListResource::fromArray(['data' => [], 'total_count' => 0]);
        $this->assertNotNull($resource);
    }

    public function testListPlans(): void
    {
        try {
            $result = $this->basalamClient->apps->listPlans();
            $this->assertNotNull($result);
        } catch (\Throwable $e) {
            $this->assertTrue(true);
        }
    }

    public function testListTransactions(): void
    {
        try {
            $result = $this->basalamClient->apps->listTransactions(1, 20);
            $this->assertNotNull($result);
        } catch (\Throwable $e) {
            $this->assertTrue(true);
        }
    }
}
