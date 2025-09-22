# Order Service

Manage baskets, payments, and invoices with the Order Service. This service provides comprehensive functionality for
handling order-related operations and payment processing: manage shopping baskets, process payments and invoices, handle
payment callbacks, track order status and product variations, and manage payable and unpaid invoices.

## Table of Contents

- [Order Methods](#order-methods)
- [Examples](#examples)

## Order Methods

### Methods

| Method                                                                 | Description                  | Parameters                                       |
|------------------------------------------------------------------------|------------------------------|--------------------------------------------------|
| [`getBaskets()`](#get-baskets-example)                                 | Get active baskets           | `refresh`                                        |
| [`getProductVariationStatus()`](#get-product-variation-status-example) | Get product variation status | `productId`                                      |
| [`createInvoicePayment()`](#create-invoice-payment-example)            | Create payment for invoice   | `invoiceId`, `request`                           |
| [`getPayableInvoices()`](#get-payable-invoices-example)                | Get payable invoices         | `page`, `perPage`                                |
| [`getUnpaidInvoices()`](#get-unpaid-invoices-example)                  | Get unpaid invoices          | `invoiceId`, `status`, `page`, `perPage`, `sort` |
| [`getPaymentCallback()`](#get-payment-callback-example)                | Get payment callback         | `paymentId`, `request`                           |
| [`createPaymentCallback()`](#create-payment-callback-example)          | Create payment callback      | `paymentId`, `request`                           |

## Examples

### Basic Setup

```php
use Basalam\BasalamClient;
use Basalam\Auth\PersonalToken;
use Basalam\Order\Models\CreatePaymentRequestModel;
use Basalam\Order\Models\PaymentCallbackRequestModel;
use Basalam\Order\Models\PaymentVerifyRequestModel;
use Basalam\Order\Models\UnpaidInvoiceStatusEnum;
use Basalam\Order\Models\OrderEnum;

$auth = new PersonalToken(
    token: "your_access_token",
    refreshToken: "your_refresh_token"
);
$client = new BasalamClient(auth: $auth);
```

### Get Baskets Example

```php
function getBasketsExample()
{
    global $client;
    
    $baskets = $client->getBaskets(
        refresh: true
    );
    
    echo "Basket ID: {$baskets->getId()}\n";
    echo "Item count: {$baskets->getItemCount()}\n";
    echo "Error count: {$baskets->getErrorCount()}\n";
    
    if ($baskets->getVendors()) {
        foreach ($baskets->getVendors() as $vendor) {
            $itemCount = $vendor->getItems() ? count($vendor->getItems()) : 0;
            echo "Vendor: {$vendor->getTitle()} - Items: {$itemCount}\n";
        }
    }
    
    return $baskets;
}
```

### Get Product Variation Status Example

```php
function getProductVariationStatusExample()
{
    global $client;
    
    $status = $client->getProductVariationStatus(
        productId: 123
    );
    
    echo "Product variation status: {$status}\n";
    return $status;
}
```

### Create Invoice Payment Example

```php
function createInvoicePaymentExample()
{
    global $client;
    
    $payment = $client->createInvoicePayment(
        invoiceId: 456,
        request: new CreatePaymentRequestModel([
            'pay_drivers' => [
                "gateway" => ["amount" => 50000],
                "credit" => ["amount" => 25000],
                "salampay" => ["amount" => 0],
                "other" => ["amount" => 0]
            ],
            'callback' => "https://example.com/callback",
            'option_code' => "OPTION123",
            'national_id' => "1234567890"
        ])
    );
    
    echo "Payment created: {$payment}\n";
    return $payment;
}
```

### Get Payable Invoices Example

```php
function getPayableInvoicesExample()
{
    global $client;
    
    $invoices = $client->getPayableInvoices(
        page: 1,
        perPage: 10
    );
    
    echo "Payable invoices: {$invoices}\n";
    return $invoices;
}
```

### Get Unpaid Invoices Example

```php
function getUnpaidInvoicesExample()
{
    global $client;
    
    $invoices = $client->getUnpaidInvoices(
        invoiceId: 123,
        status: UnpaidInvoiceStatusEnum::UNPAID,
        page: 1,
        perPage: 20,
        sort: OrderEnum::DESC
    );
    
    echo "Unpaid invoices: {$invoices}\n";
    return $invoices;
}
```

### Get Payment Callback Example

```php
function getPaymentCallbackExample()
{
    global $client;
    
    $callback = $client->getPaymentCallback(
        paymentId: 789,
        request: new PaymentCallbackRequestModel([
            'status' => "success",
            'transaction_id' => "txn_123456",
            'description' => "Payment completed successfully"
        ])
    );
    
    echo "Payment callback: {$callback}\n";
    return $callback;
}
```

### Create Payment Callback Example

```php
function createPaymentCallbackExample()
{
    global $client;
    
    $callback = $client->createPaymentCallback(
        paymentId: 789,
        request: new PaymentVerifyRequestModel([
            'payment_id' => "pay_123456",
            'transaction_id' => "txn_123456",
            'description' => "Payment verification completed"
        ])
    );
    
    echo "Payment callback created: {$callback}\n";
    return $callback;
}
```

## Payment Methods

Available payment methods include:

- `credit_card` - Credit card payments
- `debit_card` - Debit card payments
- `bank_transfer` - Bank transfer
- `digital_wallet` - Digital wallet payments
- `cash_on_delivery` - Cash on delivery

## Payment Statuses

Common payment statuses:

- `pending` - Payment is pending
- `success` - Payment completed successfully
- `failed` - Payment failed
- `cancelled` - Payment was cancelled
- `refunded` - Payment was refunded

## Next Steps

- [Upload Service](./upload.md) - File upload and management
- [Search Service](./search.md) - Search for products and entities
- [Order Processing Service](./order-processing.md) - Process orders and parcels