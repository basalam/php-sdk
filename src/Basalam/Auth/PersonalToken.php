<?php

namespace Basalam\Auth;

use Basalam\Config\Config;

class PersonalToken extends BaseAuth
{
    private string $token;
    private ?string $refreshTokenValue;
    private string $tokenType;
    private int $expiresIn;
    private ?string $scope;

    public function __construct(
        string  $token,
        ?string $refreshToken = '',
        string  $tokenType = 'Bearer',
        int     $expiresIn = 3600,
        ?string $scope = '*',
        ?Config $config = null
    )
    {
        parent::__construct($config);
        $this->token = $token;
        $this->refreshTokenValue = $refreshToken;
        $this->tokenType = $tokenType;
        $this->expiresIn = $expiresIn;
        $this->scope = $scope;

        // Initialize token info
        $this->tokenInfo = new TokenInfo(
            $this->token,
            $this->tokenType,
            $this->expiresIn,
            $this->refreshTokenValue,
            $this->scope
        );
    }

    public function getToken(array $params = []): TokenInfo
    {
        // PersonalToken simply returns the current token info
        return $this->tokenInfo;
    }

    public function refreshToken(): TokenInfo
    {
        // PersonalToken doesn't support automatic token refresh
        // It should log a message and return the current token
        error_log('Token refresh not supported for PersonalToken authentication. Please provide a new token manually.');
        return $this->tokenInfo;
    }
}