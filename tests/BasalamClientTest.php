<?php

namespace Basalam\Tests;

use Basalam\Apps\AppsService;
use Basalam\Auth\PersonalToken;
use Basalam\BasalamClient;
use Basalam\Chat\ChatService;
use Basalam\Config\Config;
use Basalam\Core\CoreService;
use Basalam\Order\OrderService;
use Basalam\OrderProcessing\OrderProcessingService;
use Basalam\Search\SearchService;
use Basalam\Shipping\ShippingService;
use Basalam\Story\StoryService;
use Basalam\Upload\UploadService;
use Basalam\Wallet\WalletService;
use Basalam\Webhook\WebhookService;
use PHPUnit\Framework\TestCase;

/**
 * Offline tests for the BasalamClient service wiring.
 */
class BasalamClientTest extends TestCase
{
    private BasalamClient $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new BasalamClient(new PersonalToken(token: 'dummy'), new Config());
    }

    public function testAllServicePropertiesResolve(): void
    {
        $this->assertInstanceOf(CoreService::class, $this->client->core);
        $this->assertInstanceOf(WalletService::class, $this->client->wallet);
        $this->assertInstanceOf(OrderService::class, $this->client->order);
        $this->assertInstanceOf(OrderProcessingService::class, $this->client->orderProcessing);
        $this->assertInstanceOf(SearchService::class, $this->client->search);
        $this->assertInstanceOf(UploadService::class, $this->client->upload);
        $this->assertInstanceOf(ChatService::class, $this->client->chat);
        $this->assertInstanceOf(WebhookService::class, $this->client->webhook);
        $this->assertInstanceOf(ShippingService::class, $this->client->shipping);
        $this->assertInstanceOf(StoryService::class, $this->client->story);
        $this->assertInstanceOf(AppsService::class, $this->client->apps);
    }

    public function testMagicGetAndIssetForNewServices(): void
    {
        $this->assertTrue(isset($this->client->shipping));
        $this->assertTrue(isset($this->client->story));
        $this->assertTrue(isset($this->client->apps));
        $this->assertInstanceOf(ShippingService::class, $this->client->__get('shipping'));
    }

    public function testOrderProcessingUnderscoreAlias(): void
    {
        $this->assertInstanceOf(OrderProcessingService::class, $this->client->order_processing);
    }

    public function testUnknownMethodThrows(): void
    {
        $this->expectException(\BadMethodCallException::class);
        $this->client->thisMethodDoesNotExistAnywhere();
    }

    public function testScopeAccessors(): void
    {
        $this->assertIsArray($this->client->getGrantedScopes());
    }
}
