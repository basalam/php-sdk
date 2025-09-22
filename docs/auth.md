# Authentication Guide

The SDK supports three main authentication methods, all managed via authentication objects implementing the `BaseAuth`
interface:

- **Personal Access Token** – for personal or dedicated applications
- **Authorization Code Flow** – for user authentication scenarios on third-party platforms
- **Client Credentials** – for applications with legal/organizational access

For more information about these methods, refer to the [Authentication in Basalam API](../../quick-start#auth) document.

## Table of Contents

- [Personal Access Token](#personal-access-token)
- [Authorization Code Flow](#authorization-code-flow-for-user-authentication)
- [Client Credentials](#client-credentials)
- [Token Management](#token-management)
- [Scopes](#scopes)

## Personal Access Token

For personal applications for a booth or user,
after [getting your token from the developer panel](https://developers.basalam.com/panel/tokens), you can manage it
using `PersonalToken`.

```php
use Basalam\BasalamClient;
use Basalam\Auth\PersonalToken;

function personalTokenExample()
{
    // Initialize with existing tokens
    $auth = new PersonalToken(
        token: "your_access_token",
        refreshToken: "your_refresh_token"
    );

    // Create an authenticated client
    $client = new BasalamClient(auth: $auth);

    // Get current user info
    $user = $client->getCurrentUser();
    return $user;
}
```

## Authorization Code Flow (for user authentication)

When building a third-party app requiring access from users,
after [creating a client in the developer panel](https://developers.basalam.com/panel/clients), use the
`AuthorizationCode` class to manage the flow.

```php
use Basalam\BasalamClient;
use Basalam\Auth\AuthorizationCode;
use Basalam\Auth\Scope;

// Step 1: Create the auth object
$auth = new AuthorizationCode(
    clientId: "your-client-id",
    clientSecret: "your-client-secret",
    redirectUri: "https://your-app.com/callback",
    scopes: [
        Scope::CUSTOMER_WALLET_READ,
        Scope::CUSTOMER_ORDER_READ
    ]
);

// Step 2: Get authorization URL
$authUrl = $auth->getAuthorizationUrl(state: "optional_state_parameter");
echo "Visit: {$authUrl}\n";

// Step 3: Exchange code for tokens (after receiving the code from the registered redirect URI)
$tokenInfo = $auth->getToken(code: "authorization_code_from_callback");

// Step 4: Create an authenticated client
$client = new BasalamClient(auth: $auth);
```

### Usage Example

```php
// Using Laravel as example framework

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Basalam\Auth\AuthorizationCode;
use Basalam\BasalamClient;

Route::get('/login', function () {
    $auth = new AuthorizationCode(
        clientId: "your-client-id",
        clientSecret: "your-client-secret",
        redirectUri: "https://your-app.com/callback"
    );

    $authUrl = $auth->getAuthorizationUrl(state: "user_session_id");
    return redirect($authUrl);
});

Route::get('/callback', function (Request $request) {
    $code = $request->get('code');
    $state = $request->get('state');

    $auth = new AuthorizationCode(
        clientId: "your-client-id",
        clientSecret: "your-client-secret",
        redirectUri: "https://your-app.com/callback"
    );

    // Exchange code for tokens
    $tokenInfo = $auth->getToken(code: $code);

    // Securely store tokens
    // ... save $tokenInfo['access_token'], $tokenInfo['refresh_token']

    return "Authentication successful!";
});
```

## Client Credentials

To use APIs requiring organizational identity (e.g., Wallet),
after [client authentication](../../quick-start#client_credentials) using `grant_type="client_credentials"`, use
`ClientCredentials`.

### Initial Configuration

```php
use Basalam\BasalamClient;
use Basalam\Auth\ClientCredentials;
use Basalam\Auth\Scope;

// Basic authentication
$auth = new ClientCredentials(
    clientId: "your-client-id",
    clientSecret: "your-client-secret",
    scopes: [
        Scope::CUSTOMER_WALLET_READ,
        Scope::VENDOR_PRODUCT_WRITE
    ]
);

// Create client
$client = new BasalamClient(auth: $auth);
```

### Usage Example

```php
use Basalam\BasalamClient;
use Basalam\Auth\ClientCredentials;

function clientCredentialsExample()
{
    $auth = new ClientCredentials(
        clientId: "your-client-id",
        clientSecret: "your-client-secret"
    );
    $client = new BasalamClient(auth: $auth);

    // Get user balance
    $balance = $client->wallet->getBalance(userId: 123);

    return $balance;
}
```

## Token Management

### Get Token Info

```php
use Basalam\BasalamClient;
use Basalam\Auth\ClientCredentials;

function tokenManagementExample()
{
    $auth = new ClientCredentials(
        clientId: "your-client-id",
        clientSecret: "your-client-secret"
    );

    // Get token – will reuse existing one if not expired
    $tokenInfo = $auth->getToken();

    return $tokenInfo;
}
```

## Scopes

Scopes define the permissions granted to your app. In addition to
the [Scopes doc](https://developers.basalam.com/scopes), the SDK provides scopes via the `Scope` class. Available scopes
include:

```php
use Basalam\Auth\Scope;

// Common scopes
Scope::CUSTOMER_WALLET_READ      // Read customer wallet
Scope::CUSTOMER_WALLET_WRITE     // Write to customer wallet
Scope::VENDOR_PRODUCT_READ       // Read vendor products
Scope::VENDOR_PRODUCT_WRITE      // Write vendor products
Scope::CUSTOMER_ORDER_READ       // Read customer orders
Scope::CUSTOMER_ORDER_WRITE      // Write customer orders
```

### Using Scopes

```php
use Basalam\Auth\ClientCredentials;
use Basalam\Auth\Scope;

$auth = new ClientCredentials(
    clientId: "your-client-id",
    clientSecret: "your-client-secret",
    scopes: [
        Scope::CUSTOMER_WALLET_READ,
        Scope::VENDOR_PRODUCT_WRITE,
        Scope::CUSTOMER_ORDER_READ
    ]
);
```