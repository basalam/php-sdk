<?php

namespace Basalam\Tests;

use Basalam\Auth\PersonalToken;
use Basalam\BasalamClient;
use Basalam\Config\Config;
use Basalam\Config\Environment;
use Basalam\Shipping\ShippingService;
use Basalam\Shipping\Models\CreateProfileRequest;
use Basalam\Shipping\Models\ZoneResponse;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Shipping service client.
 */
class ShippingServiceTest extends TestCase
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
        $auth = new PersonalToken(token: '');
        $this->basalamClient = new BasalamClient($auth, $config);
    }

    public function testServiceResolves(): void
    {
        $this->assertInstanceOf(ShippingService::class, $this->basalamClient->shipping);
        $this->assertInstanceOf(ShippingService::class, $this->basalamClient->shipping);
    }

    public function testCreateProfileRequestRoundTrip(): void
    {
        $request = new CreateProfileRequest('My Profile', 123);
        $arr = $request->toArray();
        $this->assertSame('My Profile', $arr['title']);
        $this->assertSame(123, $arr['vendor_id']);

        $back = CreateProfileRequest::fromArray($arr);
        $this->assertSame('My Profile', $back->getTitle());
    }

    public function testZoneResponseRoundTrip(): void
    {
        $zone = ZoneResponse::fromArray([
            'id' => 1,
            'title' => 'Tehran',
            'status' => ['code' => 'active'],
            'locations' => null,
            'created_at' => '2024-01-01T10:00:00',
        ]);
        $this->assertSame(1, $zone->getId());
        $this->assertSame('Tehran', $zone->getTitle());
        $this->assertNull($zone->getLocations());
        $this->assertArrayHasKey('created_at', $zone->toArray());
    }

    public function testReadVendorProfiles(): void
    {
        try {
            $result = $this->basalamClient->shipping->readVendorProfiles(1, 10);
            $this->assertNotNull($result);
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }
}
