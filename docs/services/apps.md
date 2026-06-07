# Apps Service

Handle Appstore payments and subscriptions with the Apps Service. This service provides functionality for the Basalam
Appstore payment flow: list payment methods, browse and inquire transactions, verify transactions, create
pre-transactions, list your plans and manage their subscriptions.

## Table of Contents

- [Apps Methods](#apps-methods)
- [Examples](#examples)

## Apps Methods

| Method                                                          | Description                          | Parameters                                                                  |
|----------------------------------------------------------------|--------------------------------------|----------------------------------------------------------------------------|
| [`getMethods()`](#get-methods-example)                         | List available payment methods       | `includeDisabled`, `xGatewaySecret`                                         |
| [`listTransactions()`](#list-transactions-example)            | Get transaction history              | `page`, `perPage`, `status`, `fromDate`, `toDate`, `xGatewaySecret`         |
| `listUnverified()`                                             | List unverified transactions         | `page`, `perPage`, `xGatewaySecret`                                         |
| [`inquiryTransaction()`](#inquiry-transaction-example)        | Inquire a transaction status         | `hashId`, `xGatewaySecret`                                                  |
| [`verifyTransaction()`](#verify-transaction-example)          | Manually verify a transaction        | `hashId`, `xGatewaySecret`                                                  |
| [`createPreTransaction()`](#create-pre-transaction-example)   | Create a pre-transaction             | `request`, `xGatewaySecret`                                                 |
| [`listPlans()`](#list-plans-example)                          | List the current user's plans        | `None`                                                                      |
| [`listPlanSubscriptions()`](#list-plan-subscriptions-example) | List subscriptions of plans          | `planId`, `status`, `customerId`, `page`, `perPage`                         |
| `getPlanSubscription()`                                        | Get a sold subscription's details    | `subscriptionId`                                                            |

## Examples

### Basic Setup

```php
use Basalam\BasalamClient;
use Basalam\Auth\PersonalToken;

$auth = new PersonalToken(token: "your_access_token");
$client = new BasalamClient(auth: $auth);
```

### Get Methods Example

```php
function getMethodsExample()
{
    global $client;

    $methods = $client->apps->getMethods(
        includeDisabled: false
    );

    return $methods;
}
```

### List Transactions Example

```php
function listTransactionsExample()
{
    global $client;

    $transactions = $client->apps->listTransactions(
        page: 1,
        perPage: 20,
        status: 1,
        fromDate: "2026-01-01",
        toDate: "2026-06-01"
    );

    return $transactions;
}
```

### Inquiry Transaction Example

```php
function inquiryTransactionExample()
{
    global $client;

    $transaction = $client->apps->inquiryTransaction(
        hashId: "abc123hash"
    );

    return $transaction;
}
```

### Verify Transaction Example

```php
function verifyTransactionExample()
{
    global $client;

    $transaction = $client->apps->verifyTransaction(
        hashId: "abc123hash"
    );

    return $transaction;
}
```

### Create Pre Transaction Example

```php
use Basalam\Apps\Models\CreatePreTransactionRequest;

function createPreTransactionExample()
{
    global $client;

    $preTransaction = $client->apps->createPreTransaction(
        request: new CreatePreTransactionRequest(
            referenceId: "order-456",
            amount: 150000,
            description: "Subscription purchase",
            callbackUrl: "https://your-app.com/payment/callback",
            planId: 7,
            userId: 123
        )
    );

    return $preTransaction;
}
```

### List Plans Example

```php
function listPlansExample()
{
    global $client;

    $plans = $client->apps->listPlans();
    return $plans;
}
```

### List Plan Subscriptions Example

```php
function listPlanSubscriptionsExample()
{
    global $client;

    $subscriptions = $client->apps->listPlanSubscriptions(
        planId: 7,
        status: 1,
        page: 1,
        perPage: 20
    );

    return $subscriptions;
}
```
