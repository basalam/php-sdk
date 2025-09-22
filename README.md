# Basalam PHP SDK

## Introduction

Welcome to the Basalam PHP SDK - a comprehensive client library for interacting with Basalam API services. This SDK
provides a clean, developer-friendly interface for all Basalam services. Whether you're building
a server-to-server integration or a user-facing application, this SDK provides the tools you need.

**Supported PHP Versions:** PHP 8.0+, PHP 8.1+, PHP 8.2+, PHP 8.3+

**Key Features:**

- **Type Safety**: Built with strict typing for robust type checking and validation
- **Multiple Authentication Methods**: Support for client credentials, authorization code flow, and personal tokens
- **Comprehensive Service Coverage**: Access to all Basalam services including wallet, orders, chat, and more
- **Error Handling**: Detailed error classes for different types of failures
- **Developer Friendly**: Clean API design with comprehensive documentation

![PHP Versions](https://img.shields.io/badge/php-8.0%20%7C%208.1%20%7C%208.2%20%7C%208.3-blue)
![License](https://img.shields.io/badge/license-MIT-green)

## Table of Contents

- [Introduction](#introduction)
- [Installation](#installation)
- [Quick Start](#quick-start)
- [Authentication](#authentication)
- [Services](#services)
    - [Core Service](#core-service)
    - [Chat Service](#chat-service)
    - [Order Service](#order-service)
    - [Order Processing Service](#order-processing-service)
    - [Wallet Service](#wallet-service)
    - [Search Service](#search-service)
    - [Upload Service](#upload-service)
    - [Webhook Service](#webhook-service)
- [License](#license)

## Installation

**📖 [Full Introduction Documentation](docs/intro.md)**

Install the SDK using composer:

```bash
composer require basalam/php-sdk
```

## Quick Start

### 1. Import the SDK

```php
use Basalam\BasalamClient;
use Basalam\Auth\PersonalToken;
```

### 2. Set up Authentication

```php
// Personal Token (Token-based authentication)
$auth = new PersonalToken(
    token: "your-access-token",
    refreshToken: "your-refresh-token"
);
```

### 3. Create the Client

```php
$client = new BasalamClient(auth: $auth);
```

### 4. Your First API Calls

```php
function main()
{
    // Setup
    $auth = new PersonalToken(
        token: "your-access-token",
        refreshToken: "your-refresh-token"
    );
    $client = new BasalamClient(auth: $auth);

    // Get products
    $products = $client->getProducts();
    echo "Found " . count($products) . " products\n";

    // Print first few products
    foreach (array_slice($products, 0, 3) as $product) {
        echo "Product: {$product->getName()} - Price: {$product->getPrice()}\n";
    }

    return $products;
}

// Run the function
$result = main();
```

## Authentication

**📖 [Full Authentication Documentation](docs/auth.md)**

The SDK supports three main authentication methods:

### Personal Token (For Existing Tokens)

Use this method when you already have valid access and refresh tokens:

```php
use Basalam\BasalamClient;
use Basalam\Auth\PersonalToken;

$auth = new PersonalToken(
    token: "your_existing_access_token",
    refreshToken: "your_existing_refresh_token"
);

$client = new BasalamClient(auth: $auth);
```

### Authorization Code Flow (For User Authentication)

Use this method when you need to authenticate on behalf of a user:

```php
use Basalam\BasalamClient;
use Basalam\Auth\AuthorizationCode;
use Basalam\Auth\Scope;

// Create auth object
$auth = new AuthorizationCode(
    clientId: "your-client-id",
    clientSecret: "your-client-secret",
    redirectUri: "https://your-app.com/callback",
    scopes: [Scope::CUSTOMER_WALLET_READ, Scope::CUSTOMER_ORDER_READ]
);

// Get authorization URL
$authUrl = $auth->getAuthorizationUrl(state: "optional_state_parameter");
echo "Visit: {$authUrl}\n";

// Exchange code for tokens (after user authorization)
$tokenInfo = $auth->getToken(code: "authorization_code_from_callback");

// Create authenticated client
$client = new BasalamClient(auth: $auth);
```

### Client Credentials (For Server-to-Server)

Use this method for server-to-server applications:

```php
use Basalam\BasalamClient;
use Basalam\Auth\ClientCredentials;
use Basalam\Auth\Scope;

$auth = new ClientCredentials(
    clientId: "your-client-id",
    clientSecret: "your-client-secret",
    scopes: [Scope::CUSTOMER_WALLET_READ, Scope::VENDOR_PRODUCT_WRITE]
);

$client = new BasalamClient(auth: $auth);
```

## Services

The SDK provides access to all Basalam services through a unified client interface.

### Core Service

**📖 [Full Core Service Documentation](docs/services/core.md)**

Manage vendors, products, shipping methods, user information, and more with the Core Service. This service provides
comprehensive functionality for handling core business entities and operations: create and manage vendors, handle
product creation and updates (with file upload support), manage shipping methods, update user verification and
information, handle bank account operations, and manage categories and attributes.

**Key Features:**

- Create and manage vendors
- Handle product creation and updates with file upload support
- Manage shipping methods
- Update user verification and information
- Handle bank account operations
- Manage categories and attributes

**Core Methods:**

| Method                                        | Description                                    | Parameters                                                              |
|-----------------------------------------------|------------------------------------------------|-------------------------------------------------------------------------|
| `createVendor()`                              | Create new vendor                              | `userId`, `request: CreateVendorSchema`                                 |
| `updateVendor()`                              | Update vendor                                  | `vendorId`, `request: UpdateVendorSchema`                               |
| `getVendor()`                                 | Get vendor details                             | `vendorId`, `prefer`                                                    |
| `getDefaultShippingMethods()`                 | Get default shipping methods                   | `None`                                                                  |
| `getShippingMethods()`                        | Get shipping methods                           | `ids`, `vendorIds`, `includeDeleted`, `page`, `perPage`                 |
| `getWorkingShippingMethods()`                 | Get working shipping methods                   | `vendorId`                                                              |
| `updateShippingMethods()`                     | Update shipping methods                        | `vendorId`, `request: UpdateShippingMethodSchema`                       |
| `getVendorProducts()`                         | Get vendor products                            | `vendorId`, `queryParams: GetVendorProductsSchema`                      |
| `updateVendorStatus()`                        | Update vendor status                           | `vendorId`, `request: UpdateVendorStatusSchema`                         |
| `createVendorMobileChangeRequest()`           | Create vendor mobile change                    | `vendorId`, `request: ChangeVendorMobileRequestSchema`                  |
| `createVendorMobileChangeConfirmation()`      | Confirm vendor mobile change                   | `vendorId`, `request: ChangeVendorMobileConfirmSchema`                  |
| `createProduct()`                             | Create a new product (supports file upload)    | `vendorId`, `request: ProductRequestSchema`, `photoFiles`, `videoFile`  |
| `updateBulkProducts()`                        | Update multiple products                       | `vendorId`, `request: BatchUpdateProductsRequest`                       |
| `updateProduct()`                             | Update a single product (supports file upload) | `productId`, `request: ProductRequestSchema`, `photoFiles`, `videoFile` |
| `getProduct()`                                | Get product details                            | `productId`, `prefer`                                                   |
| `getProducts()`                               | Get products list                              | `queryParams: GetProductsQuerySchema`, `prefer`                         |
| `createProductsBulkActionRequest()`           | Create bulk product updates                    | `vendorId`, `request: BulkProductsUpdateRequestSchema`                  |
| `updateProductVariation()`                    | Update product variation                       | `productId`, `variationId`, `request: UpdateProductVariationSchema`     |
| `getProductsBulkActionRequests()`             | Get bulk update status                         | `vendorId`, `page`, `perPage`                                           |
| `getProductsBulkActionRequestsCount()`        | Get bulk updates count                         | `vendorId`                                                              |
| `getProductsUnsuccessfulBulkActionRequests()` | Get failed updates                             | `requestId`, `page`, `perPage`                                          |
| `getProductShelves()`                         | Get product shelves                            | `productId`                                                             |
| `createDiscount()`                            | Create discount for products                   | `vendorId`, `request: CreateDiscountRequestSchema`                      |
| `deleteDiscount()`                            | Delete discount for products                   | `vendorId`, `request: DeleteDiscountRequestSchema`                      |
| `getCurrentUser()`                            | Get current user info                          | `None`                                                                  |
| `createUserMobileConfirmationRequest()`       | Create mobile confirmation request             | `userId`                                                                |
| `verifyUserMobileConfirmationRequest()`       | Confirm user mobile                            | `userId`, `request: ConfirmCurrentUserMobileConfirmSchema`              |
| `createUserMobileChangeRequest()`             | Create mobile change request                   | `userId`, `request: ChangeUserMobileRequestSchema`                      |
| `verifyUserMobileChangeRequest()`             | Confirm mobile change                          | `userId`, `request: ChangeUserMobileConfirmSchema`                      |
| `getUserBankAccounts()`                       | Get user bank accounts                         | `userId`, `prefer`                                                      |
| `createUserBankAccount()`                     | Create user bank account                       | `userId`, `request: UserCardsSchema`, `prefer`                          |
| `verifyUserBankAccountOtp()`                  | Verify bank account OTP                        | `userId`, `request: UserCardsOtpSchema`                                 |
| `verifyUserBankAccount()`                     | Verify bank accounts                           | `userId`, `request: UserVerifyBankInformationSchema`                    |
| `deleteUserBankAccount()`                     | Delete bank account                            | `userId`, `bankAccountId`                                               |
| `updateUserBankAccount()`                     | Update bank account                            | `bankAccountId`, `request: UpdateUserBankInformationSchema`             |
| `updateUserVerification()`                    | Update user verification                       | `userId`, `request: UserVerificationSchema`                             |
| `getCategoryAttributes()`                     | Get category attributes                        | `categoryId`, `productId`, `vendorId`, `excludeMultiSelects`            |
| `getCategories()`                             | Get all categories                             | `None`                                                                  |
| `getCategory()`                               | Get specific category                          | `categoryId`                                                            |

**Example:**

```php
use Basalam\Core\Models\CreateVendorSchema;

// Create a new vendor
$vendor = $client->createVendor(
    userId: 123,
    request: new CreateVendorSchema([
        'title' => "My Store",
        'identifier' => "store123",
        'category_type' => 1,
        'city' => 1,
        'summary' => "A great store for all your needs"
    ])
);

// Get vendor details
$vendorDetails = $client->getVendor(vendorId: $vendor->getId());
```

### Chat Service

**📖 [Full Chat Service Documentation](docs/services/chat.md)**

Handle messaging and chat functionalities with the Chat Service. This service provides comprehensive tools for managing
conversations, messages, and chat interactions.

**Key Features:**

- Create and manage chat conversations
- Send and retrieve messages
- Handle different message types
- Manage chat participants
- Track chat history and updates

**Methods:**

| Method            | Description       | Parameters                                                                                      |
|-------------------|-------------------|-------------------------------------------------------------------------------------------------|
| `createMessage()` | Create a message  | `request`, `userAgent`, `xClientInfo`, `adminToken`                                             |
| `createChat()`    | Create a chat     | `request`, `xCreationTags`, `xUserSession`, `xClientInfo`                                       |
| `getMessages()`   | Get chat messages | `chatId`, `msgId`, `limit`, `chatType`, `order`, `op`, `tempId`                                 |
| `getChats()`      | Get chats list    | `limit`, `orderBy`, `updatedFrom`, `updatedBefore`, `modifiedFrom`, `modifiedBefore`, `filters` |

**Example:**

```php
use Basalam\Chat\Models\MessageRequest;

// Create a message
$message = $client->createMessage(
    request: new MessageRequest([
        'chat_id' => 123,
        'content' => "Hello, how can I help you?",
        'message_type' => "text"
    ]),
    userAgent: "MyApp/1.0",
    xClientInfo: "web"
);

// Get messages from a chat
$messages = $client->getMessages(
    chatId: 123,
    limit: 20,
    order: "DESC"
);
```

### Order Service

**📖 [Full Order Service Documentation](docs/services/order.md)**

Manage baskets, payments, and invoices with the Order Service. This service provides comprehensive functionality for
handling order-related operations and payment processing.

**Key Features:**

- Manage shopping baskets
- Process payments and invoices
- Handle payment callbacks
- Track order status and product variations
- Manage payable and unpaid invoices

**Methods:**

| Method                        | Description                  | Parameters                                       |
|-------------------------------|------------------------------|--------------------------------------------------|
| `getBaskets()`                | Get active baskets           | `refresh`                                        |
| `getProductVariationStatus()` | Get product variation status | `productId`                                      |
| `createInvoicePayment()`      | Create payment for invoice   | `invoiceId`, `request`                           |
| `getPayableInvoices()`        | Get payable invoices         | `page`, `perPage`                                |
| `getUnpaidInvoices()`         | Get unpaid invoices          | `invoiceId`, `status`, `page`, `perPage`, `sort` |
| `getPaymentCallback()`        | Get payment callback         | `paymentId`, `request`                           |
| `createPaymentCallback()`     | Create payment callback      | `paymentId`, `request`                           |

**Example:**

```php
use Basalam\Order\Models\CreatePaymentRequestModel;

// Get active baskets
$baskets = $client->getBaskets(refresh: true);

// Create payment for invoice
$payment = $client->createInvoicePayment(
    invoiceId: 123,
    request: new CreatePaymentRequestModel([
        'payment_method' => "credit_card",
        'amount' => 10000
    ])
);
```

### Order Processing Service

**📖 [Full Order Processing Service Documentation](docs/services/order_processing.md)**

Manage customer orders, vendor parcels, and the entire order lifecycle with the Order Processing Service. This service
provides comprehensive functionality to get and manage customer orders, track order items and details, handle vendor
parcels and shipping, generate order statistics, and monitor order status and updates.

**Key Features:**

- Get and manage customer orders
- Track order items and details
- Handle vendor parcels and shipping
- Generate order statistics
- Monitor order status and updates

**Methods:**

| Method                     | Description          | Parameters                                                                           |
|----------------------------|----------------------|--------------------------------------------------------------------------------------|
| `getCustomerOrders()`      | Get orders           | `filters` (OrderFilter)                                                              |
| `getCustomerOrder()`       | Get specific order   | `orderId`                                                                            |
| `getCustomerOrderItems()`  | Get order items      | `filters` (ItemFilter)                                                               |
| `getCustomerOrderItem()`   | Get specific item    | `itemId`                                                                             |
| `getVendorOrdersParcels()` | Get orders parcels   | `filters` (OrderParcelFilter)                                                        |
| `getOrderParcel()`         | Get specific parcel  | `parcelId`                                                                           |
| `getOrdersStats()`         | Get order statistics | `resourceCount`, `vendorId`, `productId`, `customerId`, `couponCode`, `cacheControl` |

**Example:**

```php
use Basalam\OrderProcessing\Models\OrderFilter;

// Get orders with filters
$orders = $client->getCustomerOrders(
    filters: new OrderFilter([
        'coupon_code' => "SAVE10",
        'cursor' => "next_cursor_123",
        'customer_ids' => "123,456,789",
        'customer_name' => "John Doe"
    ])
);

// Get specific order details
$order = $client->getCustomerOrder(orderId: 123);
```

### Wallet Service

**📖 [Full Wallet Service Documentation](docs/services/wallet.md)**

Manage user balances, expenses, and refunds with the Wallet Service. This service provides comprehensive functionality
for handling user financial operations.

**Key Features:**

- Get user balance and transaction history
- Create and manage expenses
- Process refunds
- Handle credit-specific operations

**Methods:**

| Method                      | Description                         | Parameters                                                             |
|-----------------------------|-------------------------------------|------------------------------------------------------------------------|
| `getBalance()`              | Get user's balance                  | `userId`, `filters`, `xOperatorId`                                     |
| `getTransactions()`         | Get transaction history             | `userId`, `page`, `perPage`, `xOperatorId`                             |
| `createExpense()`           | Create an expense                   | `userId`, `request`, `xOperatorId`                                     |
| `createExpenseFromCredit()` | Create expense from specific credit | `userId`, `creditId`, `request`, `xOperatorId`                         |
| `getExpense()`              | Get expense details                 | `userId`, `expenseId`, `xOperatorId`                                   |
| `deleteExpense()`           | Delete/rollback expense             | `userId`, `expenseId`, `rollbackReasonId`, `xOperatorId`               |
| `getExpenseByRef()`         | Get expense by reference            | `userId`, `reasonId`, `referenceId`, `xOperatorId`                     |
| `deleteExpenseByRef()`      | Delete expense by reference         | `userId`, `reasonId`, `referenceId`, `rollbackReasonId`, `xOperatorId` |
| `createRefund()`            | Process a refund                    | `request`, `xOperatorId`                                               |
| `canRollbackRefund()`       | Check if refund can be rolled back  | `refundReason`, `refundReferenceId`, `xOperatorId`                     |
| `rollbackRefund()`          | Rollback a refund                   | `request`, `xOperatorId`                                               |

**Example:**

```php
use Basalam\Wallet\Models\SpendCreditRequest;

// Get user balance
$balance = $client->getBalance(userId: 123);

// Create an expense
$expense = $client->createExpense(
    userId: 123,
    request: new SpendCreditRequest([
        'reason_id' => 1,
        'reference_id' => 456,
        'amount' => 10000,
        'description' => "Payment for order #456",
        'types' => [1, 2],
        'settleable' => true
    ])
);
```

### Search Service

**📖 [Full Search Service Documentation](docs/services/search.md)**

Search for products and entities with the Search Service. This service provides powerful search capabilities.

**Key Features:**

- Search for products with advanced filters
- Apply price ranges and category filters
- Sort results by various criteria
- Paginate through search results
- Get detailed product information

**Methods:**

| Method             | Description         | Parameters |
|--------------------|---------------------|------------|
| `searchProducts()` | Search for products | `request`  |

**Example:**

```php
use Basalam\Search\Models\ProductSearchModel;

// Search for products
$results = $client->searchProducts(
    request: new ProductSearchModel([
        'query' => "laptop",
        'category_id' => 123,
        'min_price' => 100000,
        'max_price' => 500000,
        'sort_by' => "price",
        'sort_order' => "asc",
        'page' => 1,
        'per_page' => 20
    ])
);
```

### Upload Service

**📖 [Full Upload Service Documentation](docs/services/upload.md)**

Upload and manage files with the Upload Service. This service provides secure file upload capabilities.

**Key Features:**

- Upload files securely
- Support various file types (images, documents, videos)
- Set custom file names and expiration times
- Get file URLs for access
- Manage file lifecycle

**Methods:**

| Method         | Description   | Parameters                                              |
|----------------|---------------|---------------------------------------------------------|
| `uploadFile()` | Upload a file | `file`, `fileType`, `customUniqueName`, `expireMinutes` |

**Example:**

```php
use Basalam\Upload\Models\UserUploadFileTypeEnum;

// Upload a file
$result = $client->uploadFile(
    file: "image.jpg",
    fileType: UserUploadFileTypeEnum::PRODUCT_PHOTO,
    customUniqueName: "my-product-image",
    expireMinutes: 1440  // 24 hours
);

echo "File uploaded: {$result->getUrl()}\n";
```

### Webhook Service

**📖 [Full Webhook Service Documentation](docs/services/webhook.md)**

Manage webhook subscriptions and events with the Webhook Service. This service allows you to receive real-time
notifications about events happening in your Basalam account.

**Key Features:**

- Create and manage webhook subscriptions
- Handle different types of events
- Monitor webhook logs and delivery status
- Register and unregister clients to webhooks

**Methods:**

| Method                    | Description                | Parameters                     |
|---------------------------|----------------------------|--------------------------------|
| `getWebhookServices()`    | Get webhook services       | None                           |
| `createWebhookService()`  | Create webhook service     | `request`                      |
| `getWebhooks()`           | Get webhooks list          | `serviceId`, `eventIds`        |
| `createWebhook()`         | Create new webhook         | `request`                      |
| `updateWebhook()`         | Update webhook             | `webhookId`, `request`         |
| `deleteWebhook()`         | Delete webhook             | `webhookId`                    |
| `getWebhookEvents()`      | Get available events       | None                           |
| `getWebhookCustomers()`   | Get webhook customers      | `page`, `perPage`, `webhookId` |
| `getWebhookLogs()`        | Get webhook logs           | `webhookId`                    |
| `registerWebhook()`       | Register client to webhook | `request`                      |
| `unregisterWebhook()`     | Unregister client          | `request`                      |
| `getRegisteredWebhooks()` | Get registered webhooks    | `page`, `perPage`, `serviceId` |

**Example:**

```php
use Basalam\Webhook\Models\CreateWebhookRequest;

// Create a new webhook
$webhook = $client->createWebhook(
    request: new CreateWebhookRequest([
        'service_id' => 1,
        'event_ids' => ["order.created", "payment.completed"],
        'request_method' => "POST",
        'url' => "https://your-app.com/webhook",
        'is_active' => true
    ])
);

// Get webhook events
$events = $client->getWebhookEvents();
```

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.