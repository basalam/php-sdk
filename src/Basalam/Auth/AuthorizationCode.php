<?php

namespace Basalam\Auth;

use Basalam\Config\Config;
use Basalam\Exceptions\AuthException;

class AuthorizationCode extends BaseAuth
{
    private string $clientId;
    private string $clientSecret;
    private string $redirectUri;
    private string $scope;

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $redirectUri
     * @param array|string $scopes Default is ['*']
     * @param Config|null $config
     */
    public function __construct(
        string  $clientId,
        string  $clientSecret,
        string  $redirectUri,
                $scopes = ['*'],
        ?Config $config = null
    )
    {
        parent::__construct($config);
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUri = $redirectUri;

        // Handle scope formatting
        if (is_array($scopes)) {
            $scopeValues = [];
            foreach ($scopes as $s) {
                $scopeValues[] = $s;
            }
            $this->scope = implode(' ', $scopeValues);
        } else {
            $this->scope = $scopes;
        }
    }

    public function getAuthorizationUrl(?string $state = null): string
    {
        $params = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUri,
        ];

        if ($this->scope) {
            $params['scope'] = $this->scope;
        }

        if ($state) {
            $params['state'] = $state;
        }

        return $this->config->getAuthorizeUrl() . '?' . http_build_query($params);
    }

    public function getToken(array $params = []): TokenInfo
    {
        // Check if token is already available and not expired
        if ($this->tokenInfo && !$this->tokenInfo->isExpired()) {
            return $this->tokenInfo;
        }

        $code = $params['code'] ?? null;

        // If no code provided and no token available, raise error
        if (!$code) {
            if (!$this->tokenInfo) {
                throw new AuthException('No token available. You must provide an authorization code.');
            }
            return $this->tokenInfo;
        }

        $data = [
            'grant_type' => GrantType::AUTHORIZATION_CODE,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $this->redirectUri,
            'code' => $code,
        ];

        $this->tokenInfo = $this->requestToken($data);
        return $this->tokenInfo;
    }

    public function refreshToken(): TokenInfo
    {
        if (!$this->tokenInfo || !$this->tokenInfo->getRefreshToken()) {
            throw new AuthException('No refresh token available');
        }

        $data = [
            'grant_type' => GrantType::REFRESH_TOKEN,
            'refresh_token' => $this->tokenInfo->getRefreshToken(),
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];

        $this->tokenInfo = $this->requestToken($data);
        return $this->tokenInfo;
    }
}