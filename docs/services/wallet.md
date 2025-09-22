# Wallet Service

Manage user balances, expenses, and refunds with the Wallet Service. This service provides comprehensive functionality
for handling user financial operations: get user balance and transaction history, create and manage expenses, process
refunds, and handle credit-specific operations.

## Table of Contents

- [Wallet Methods](#wallet-methods)
- [Examples](#examples)

## Wallet Methods

### Methods

| Method                                                             | Description                         | Parameters                                                             |
|--------------------------------------------------------------------|-------------------------------------|------------------------------------------------------------------------|
| [`getBalance()`](#get-balance-example)                             | Get user's balance                  | `userId`, `filters`, `xOperatorId`                                     |
| [`getTransactions()`](#get-transactions-example)                   | Get transaction history             | `userId`, `page`, `perPage`, `xOperatorId`                             |
| [`createExpense()`](#create-expense-example)                       | Create an expense                   | `userId`, `request`, `xOperatorId`                                     |
| [`createExpenseFromCredit()`](#create-expense-from-credit-example) | Create expense from specific credit | `userId`, `creditId`, `request`, `xOperatorId`                         |
| [`getExpense()`](#get-expense-example)                             | Get expense details                 | `userId`, `expenseId`, `xOperatorId`                                   |
| [`deleteExpense()`](#delete-expense-example)                       | Delete/rollback expense             | `userId`, `expenseId`, `rollbackReasonId`, `xOperatorId`               |
| [`getExpenseByRef()`](#get-expense-by-ref-example)                 | Get expense by reference            | `userId`, `reasonId`, `referenceId`, `xOperatorId`                     |
| [`deleteExpenseByRef()`](#delete-expense-by-ref-example)           | Delete expense by reference         | `userId`, `reasonId`, `referenceId`, `rollbackReasonId`, `xOperatorId` |
| [`createRefund()`](#create-refund-example)                         | Process a refund                    | `request`, `xOperatorId`                                               |
| [`canRollbackRefund()`](#can-rollback-refund-example)              | Check if refund can be rolled back  | `refundReason`, `refundReferenceId`, `xOperatorId`                     |
| [`rollbackRefund()`](#rollback-refund-example)                     | Rollback a refund                   | `request`, `xOperatorId`                                               |

## Examples

### Basic Setup

```php
use Basalam\BasalamClient;
use Basalam\Auth\PersonalToken;
use Basalam\Wallet\Models\SpendCreditRequest;
use Basalam\Wallet\Models\SpendSpecificCreditRequest;
use Basalam\Wallet\Models\RefundRequest;
use Basalam\Wallet\Models\RollbackRefundRequest;
use Basalam\Wallet\Models\BalanceFilter;

$auth = new PersonalToken(
    token: "your_access_token",
    refreshToken: "your_refresh_token"
);
$client = new BasalamClient(auth: $auth);
```

### Get Balance Example

```php
function getBalanceExample()
{
    global $client;
    
    $balance = $client->getBalance(
        userId: 123,
        filters: [
            new BalanceFilter([
                'cash' => true,
                'settleable' => true,
                'vendor' => false,
                'customer' => true
            ])
        ],
        xOperatorId: 456
    );
    
    echo "User balance: {$balance}\n";
    return $balance;
}
```

### Get Transactions Example

```php
function getTransactionsExample()
{
    global $client;
    
    $transactions = $client->getTransactions(
        userId: 123,
        page: 1,
        perPage: 20,
        xOperatorId: 456
    );
    
    foreach ($transactions->getData() as $transaction) {
        echo "Transaction: {$transaction->getTime()} - Amount: {$transaction->getAmount()}\n";
    }
    
    return $transactions;
}
```

### Create Expense Example

```php
function createExpenseExample()
{
    global $client;
    
    $expense = $client->createExpense(
        userId: 123,
        request: new SpendCreditRequest([
            'reason_id' => 1,
            'reference_id' => 456,
            'amount' => 10000,
            'description' => "Payment for order #456",
            'types' => [1, 2],
            'settleable' => true,
            'references' => [
                "order_id" => 456,
                "payment_method" => 1
            ]
        ]),
        xOperatorId: 456
    );
    
    echo "Expense created: {$expense->getId()}\n";
    return $expense;
}
```

### Create Expense From Credit Example

```php
function createExpenseFromCreditExample()
{
    global $client;
    
    $expense = $client->createExpenseFromCredit(
        userId: 123,
        creditId: 789,
        request: new SpendSpecificCreditRequest([
            'reason_id' => 1,
            'reference_id' => 456,
            'amount' => 5000,
            'description' => "Payment from specific credit",
            'settleable' => true,
            'references' => [
                "order_id" => 456,
                "credit_type" => 1
            ]
        ]),
        xOperatorId: 456
    );
    
    echo "Specific credit expense created: {$expense->getId()}\n";
    return $expense;
}
```

### Get Expense Example

```php
function getExpenseExample()
{
    global $client;
    
    $expense = $client->getExpense(
        userId: 123,
        expenseId: 456,
        xOperatorId: 456
    );
    
    echo "Expense amount: {$expense->getAmount()}\n";
    echo "Expense description: {$expense->getDescription()}\n";
    
    return $expense;
}
```

### Delete Expense Example

```php
function deleteExpenseExample()
{
    global $client;
    
    $result = $client->deleteExpense(
        userId: 123,
        expenseId: 456,
        rollbackReasonId: 2,
        xOperatorId: 456
    );
    
    echo "Expense deleted: {$result->getId()}\n";
    return $result;
}
```

### Get Expense By Ref Example

```php
function getExpenseByRefExample()
{
    global $client;
    
    $expense = $client->getExpenseByRef(
        userId: 123,
        reasonId: 1,
        referenceId: 456,
        xOperatorId: 456
    );
    
    if ($expense) {
        echo "Found expense: {$expense->getId()}\n";
    }
    return $expense;
}
```

### Delete Expense By Ref Example

```php
function deleteExpenseByRefExample()
{
    global $client;
    
    $result = $client->deleteExpenseByRef(
        userId: 123,
        reasonId: 1,
        referenceId: 456,
        rollbackReasonId: 2,
        xOperatorId: 456
    );
    
    echo "Expense deleted by reference: {$result->getId()}\n";
    return $result;
}
```

### Create Refund Example

```php
function createRefundExample()
{
    global $client;
    
    $refund = $client->createRefund(
        request: new RefundRequest([
            'original_reason' => 1,
            'original_reference_id' => 456,
            'reason' => 2,
            'reference_id' => 789,
            'amount' => 5000,
            'description' => "Refund for cancelled order",
            'references' => [
                [
                    "reference_type_id" => 1,
                    "reference_id" => 456
                ]
            ]
        ]),
        xOperatorId: 456
    );
    
    echo "Refund processed: {$refund->getId()}\n";
    return $refund;
}
```

### Can Rollback Refund Example

```php
function canRollbackRefundExample()
{
    global $client;
    
    $canRollback = $client->canRollbackRefund(
        refundReason: 2,
        refundReferenceId: 789,
        xOperatorId: 456
    );
    
    echo "Can rollback refund: {$canRollback->getStatus()}\n";
    echo "Message: {$canRollback->getMessage()}\n";
    
    return $canRollback;
}
```

### Rollback Refund Example

```php
function rollbackRefundExample()
{
    global $client;
    
    $result = $client->rollbackRefund(
        request: new RollbackRefundRequest([
            'refund_reason' => 2,
            'rollback_refund_reason' => 3,
            'refund_reference_id' => 789,
            'reference_id' => 456,
            'description' => "Rollback refund due to error",
            'references' => [
                [
                    "reference_type_id" => 1,
                    "reference_id" => 456
                ]
            ]
        ]),
        xOperatorId: 456
    );
    
    echo "Refund rolled back: {$result->getId()}\n";
    return $result;
}
```

## Next Steps

- [Webhook Service](./webhook.md) - Handle webhook subscriptions
- [Chat Service](./chat.md) - Messaging and chat functionalities
- [Order Service](./order.md) - Manage orders and payments