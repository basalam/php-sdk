<?php

namespace Basalam\Auth;

use Basalam\Config\Config;
use Basalam\Exceptions\AuthException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

abstract class BaseAuth
{
    protected Config $config;
    protected ?TokenInfo $tokenInfo = null;
    protected Client $httpClient;

    public function __construct(?Config $config = null)
    {
        $this->config = $config ?? new Config();
        $this->httpClient = new Client([
            'timeout' => $this->config->getTimeout(),
            'headers' => $this->config->getHeaders(),
        ]);
    }

    public function getAuthHeaders(): array
    {
        // If no token or token should be refreshed
        if (!$this->tokenInfo || $this->tokenInfo->shouldRefresh()) {
            // If we have a token info, try to refresh, otherwise get new token
            $this->tokenInfo = $this->tokenInfo ? $this->refreshToken() : $this->getToken();
        }

        return [
            'Authorization' => $this->tokenInfo->getTokenType() . ' ' . $this->tokenInfo->getAccessToken(),
        ];
    }

    abstract public function refreshToken(): TokenInfo;

    abstract public function getToken(array $params = []): TokenInfo;

    public function getTokenInfo(): ?TokenInfo
    {
        return $this->tokenInfo;
    }

    public function hasScope(string $scope): bool
    {
        if (!$this->tokenInfo) {
            return false;
        }
        return $this->tokenInfo->hasScope($scope);
    }

    public function getGrantedScopes(): array
    {
        if (!$this->tokenInfo) {
            return [];
        }
        return $this->tokenInfo->getGrantedScopes();
    }

    protected function requestToken(array $data): TokenInfo
    {
        try {
            $response = $this->httpClient->post($this->config->getTokenUrl(), [
                'form_params' => $data,
            ]);

            $responseData = json_decode($response->getBody()->getContents(), true);

            if (isset($responseData['error'])) {
                throw new AuthException(
                    message: $responseData['error_description'] ?? $responseData['error'],
                    response: $response,
                    responseData: $responseData
                );
            }

            return TokenInfo::fromArray($responseData);
        } catch (GuzzleException $e) {
            throw new AuthException(
                message: 'Failed to request token: ' . $e->getMessage(),
                response: null,
                responseData: null,
                previous: $e
            );
        }
    }
}