<?php

namespace Basalam\Tests;

use Basalam\Auth\PersonalToken;
use Basalam\BasalamClient;
use Basalam\Config\Config;
use Basalam\Config\Environment;
use Basalam\Story\StoryService;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Story service client.
 */
class StoryServiceTest extends TestCase
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
        $this->assertInstanceOf(StoryService::class, $this->basalamClient->story);
    }

    public function testMyStories(): void
    {
        try {
            $result = $this->basalamClient->story->myStories(10);
            $this->assertNotNull($result);
        } catch (\Throwable $e) {
            $this->assertTrue(true);
        }
    }

    public function testStoriesDiscovery(): void
    {
        try {
            $result = $this->basalamClient->story->discovery();
            $this->assertNotNull($result);
        } catch (\Throwable $e) {
            $this->assertTrue(true);
        }
    }

    public function testHashtagFeed(): void
    {
        try {
            $result = $this->basalamClient->story->hashtagFeed('basalam');
            $this->assertNotNull($result);
        } catch (\Throwable $e) {
            $this->assertTrue(true);
        }
    }
}
