<?php

namespace Basalam\Tests;

use Basalam\Auth\PersonalToken;
use PHPUnit\Framework\TestCase;

/**
 * Offline tests for authentication.
 */
class AuthTest extends TestCase
{
    public function testPersonalTokenProducesBearerHeader(): void
    {
        $auth = new PersonalToken(token: 'my-token');
        $headers = $auth->getAuthHeaders();
        $this->assertArrayHasKey('Authorization', $headers);
        $this->assertSame('Bearer my-token', $headers['Authorization']);
    }

    public function testGetTokenReturnsTokenInfo(): void
    {
        $auth = new PersonalToken(token: 'abc');
        $tokenInfo = $auth->getToken();
        $this->assertSame('abc', $tokenInfo->getAccessToken());
    }

    public function testScopeHandling(): void
    {
        $auth = new PersonalToken(token: 'abc', scope: '*');
        $this->assertIsArray($auth->getGrantedScopes());
    }
}
