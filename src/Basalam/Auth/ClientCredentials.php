<?php

namespace Basalam\Auth;

use Basalam\Config\Config;

class ClientCredentials extends BaseAuth
{
    private string $clientId;
    private string $clientSecret;
    private string $scope;

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param array|string $scopes Default is ['*']
     * @param Config|null $config
     */
    public function __construct(
        string  $clientId,
        string  $clientSecret,
                $scopes = ['*'],
        ?Config $config = null
    )
    {
        parent::__construct($config);
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;

        if (is_array($scopes)) {
            $scopeValues = [];
            foreach ($scopes as $s) {
                // If it's a constant from Scope class, use it directly
                // Otherwise, use the string value
                $scopeValues[] = $s;
            }
            $this->scope = implode(' ', $scopeValues);
        } else {
            $this->scope = $scopes;
        }
    }

    public function refreshToken(): TokenInfo
    {
        // Client credentials doesn't use refresh tokens - just get a new token
        return $this->getToken();
    }

    public function getToken(array $params = []): TokenInfo
    {
        // Check if token exists and is still valid
        if ($this->tokenInfo && !$this->tokenInfo->shouldRefresh()) {
            return $this->tokenInfo;
        }

        $data = [
            'grant_type' => GrantType::CLIENT_CREDENTIALS,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'scope' => $this->scope,
        ];

        $this->tokenInfo = $this->requestToken($data);
        return $this->tokenInfo;
    }
}