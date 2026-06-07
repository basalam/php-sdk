<?php

namespace Basalam\Tests;

use Basalam\Config\Config;
use Basalam\Config\Environment;
use PHPUnit\Framework\TestCase;

/**
 * Offline tests for the Config class.
 */
class ConfigTest extends TestCase
{
    public function testDefaults(): void
    {
        $config = new Config();
        $this->assertSame(Environment::PRODUCTION, $config->getEnvironment());
        $this->assertSame('https://basalam.com', $config->getBaseUrl());
        $this->assertNotEmpty($config->getUserAgent());
        $this->assertSame('v1', $config->getApiVersion());
    }

    public function testServiceUrlsIncludeNewServices(): void
    {
        $config = new Config();
        foreach (['core', 'wallet', 'chat', 'order', 'order-processing', 'search', 'upload', 'webhook', 'shipping', 'story', 'apps'] as $service) {
            $this->assertNotNull($config->getServiceConfig($service), "Missing service config: $service");
            $this->assertStringContainsString('openapi.basalam.com', $config->getServiceUrl($service));
        }
    }

    public function testDevelopmentEnvironment(): void
    {
        $config = new Config(environment: Environment::DEVELOPMENT);
        $this->assertSame(Environment::DEVELOPMENT, $config->getEnvironment());
        $this->assertSame('https://basalam.dev', $config->getBaseUrl());
    }

    public function testHeadersContainUserAgent(): void
    {
        $config = new Config();
        $headers = $config->getHeaders();
        $this->assertArrayHasKey('User-Agent', $headers);
    }
}
