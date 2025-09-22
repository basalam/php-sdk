<?php

namespace Basalam\Auth;

class TokenInfo
{
    private string $accessToken;
    private string $tokenType;
    private int $expiresIn;
    private ?string $refreshToken;
    private ?string $scope;
    private float $createdAt;

    public function __construct(
        string  $accessToken,
        string  $tokenType = 'Bearer',
        int     $expiresIn = 3600,
        ?string $refreshToken = null,
        ?string $scope = null,
        ?float  $createdAt = null
    )
    {
        $this->accessToken = $accessToken;
        $this->tokenType = $tokenType;
        $this->expiresIn = $expiresIn;
        $this->refreshToken = $refreshToken;
        $this->scope = $scope;
        $this->createdAt = $createdAt ?? time();
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['access_token'] ?? $data['token'],
            $data['token_type'] ?? 'Bearer',
            $data['expires_in'] ?? 3600,
            $data['refresh_token'] ?? null,
            $data['scope'] ?? null,
            $data['created_at'] ?? null
        );
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    public function getScope(): ?string
    {
        return $this->scope;
    }

    public function getCreatedAt(): float
    {
        return $this->createdAt;
    }

    public function isExpired(): bool
    {
        return time() >= $this->getExpiresAt();
    }

    public function getExpiresAt(): float
    {
        return $this->createdAt + $this->expiresIn;
    }

    public function shouldRefresh(): bool
    {
        // Refresh if expires in less than 5 minutes
        return time() >= ($this->getExpiresAt() - 300);
    }

    public function hasScope(string $scope): bool
    {
        return in_array($scope, $this->getGrantedScopes());
    }

    public function getGrantedScopes(): array
    {
        if (!$this->scope) {
            return [];
        }
        return explode(' ', $this->scope);
    }
}