# Core Service

Manage vendors, products, shipping methods, user information, and more with the Core Service. This service provides
comprehensive functionality for handling core business entities and operations: create and manage vendors, handle
product creation and updates (with file upload support), manage shipping methods, update user verification and
information, handle bank account operations, and manage categories and attributes.

## Table of Contents

- [Core Methods](#core-methods)
- [Examples](#examples)

## Core Methods

| Method                                                                                           | Description                                    | Parameters                                                              |
|--------------------------------------------------------------------------------------------------|------------------------------------------------|-------------------------------------------------------------------------|
| [`createVendor()`](#create-vendor)                                                               | Create new vendor                              | `userId`, `request: CreateVendorSchema`                                 |
| [`updateVendor()`](#update-vendor)                                                               | Update vendor                                  | `vendorId`, `request: UpdateVendorSchema`                               |
| [`getVendor()`](#get-vendor)                                                                     | Get vendor details                             | `vendorId`, `prefer`                                                    |
| [`getDefaultShippingMethods()`](#get-default-shipping-methods)                                   | Get default shipping methods                   | `None`                                                                  |
| [`getShippingMethods()`](#get-shipping-methods)                                                  | Get shipping methods                           | `ids`, `vendorIds`, `includeDeleted`, `page`, `perPage`                 |
| [`getWorkingShippingMethods()`](#get-working-shipping-methods)                                   | Get working shipping methods                   | `vendorId`                                                              |
| [`updateShippingMethods()`](#update-shipping-methods)                                            | Update shipping methods                        | `vendorId`, `request: UpdateShippingMethodSchema`                       |
| [`getVendorProducts()`](#get-vendor-products)                                                    | Get vendor products                            | `vendorId`, `queryParams: GetVendorProductsSchema`                      |
| [`updateVendorStatus()`](#update-vendor-status)                                                  | Update vendor status                           | `vendorId`, `request: UpdateVendorStatusSchema`                         |
| [`createVendorMobileChangeRequest()`](#create-vendor-mobile-change-request)                      | Create vendor mobile change                    | `vendorId`, `request: ChangeVendorMobileRequestSchema`                  |
| [`createVendorMobileChangeConfirmation()`](#create-vendor-mobile-change-confirmation)            | Confirm vendor mobile change                   | `vendorId`, `request: ChangeVendorMobileConfirmSchema`                  |
| [`createProduct()`](#create-product)                                                             | Create a new product (supports file upload)    | `vendorId`, `request: ProductRequestSchema`, `photoFiles`, `videoFile`  |
| [`updateBulkProducts()`](#update-bulk-products)                                                  | Update multiple products                       | `vendorId`, `request: BatchUpdateProductsRequest`                       |
| [`updateProduct()`](#update-product)                                                             | Update a single product (supports file upload) | `productId`, `request: ProductRequestSchema`, `photoFiles`, `videoFile` |
| [`getProduct()`](#get-product)                                                                   | Get product details                            | `productId`, `prefer`                                                   |
| [`getProducts()`](#get-products)                                                                 | Get products list                              | `queryParams: GetProductsQuerySchema`, `prefer`                         |
| [`createProductsBulkActionRequest()`](#create-products-bulk-action-request)                      | Create bulk product updates                    | `vendorId`, `request: BulkProductsUpdateRequestSchema`                  |
| [`updateProductVariation()`](#update-product-variation)                                          | Update product variation                       | `productId`, `variationId`, `request: UpdateProductVariationSchema`     |
| [`getProductsBulkActionRequests()`](#get-products-bulk-action-requests)                          | Get bulk update status                         | `vendorId`, `page`, `perPage`                                           |
| [`getProductsBulkActionRequestsCount()`](#get-products-bulk-action-requests-count)               | Get bulk updates count                         | `vendorId`                                                              |
| [`getProductsUnsuccessfulBulkActionRequests()`](#get-products-unsuccessful-bulk-action-requests) | Get failed updates                             | `requestId`, `page`, `perPage`                                          |
| [`getProductShelves()`](#get-product-shelves)                                                    | Get product shelves                            | `productId`                                                             |
| [`createDiscount()`](#create-discount)                                                           | Create discount for products                   | `vendorId`, `request: CreateDiscountRequestSchema`                      |
| [`deleteDiscount()`](#delete-discount)                                                           | Delete discount for products                   | `vendorId`, `request: DeleteDiscountRequestSchema`                      |
| [`getCurrentUser()`](#get-current-user)                                                          | Get current user info                          | `None`                                                                  |
| [`createUserMobileConfirmationRequest()`](#create-user-mobile-confirmation-request)              | Create mobile confirmation request             | `userId`                                                                |
| [`verifyUserMobileConfirmationRequest()`](#verify-user-mobile-confirmation-request)              | Confirm user mobile                            | `userId`, `request: ConfirmCurrentUserMobileConfirmSchema`              |
| [`createUserMobileChangeRequest()`](#create-user-mobile-change-request)                          | Create mobile change request                   | `userId`, `request: ChangeUserMobileRequestSchema`                      |
| [`verifyUserMobileChangeRequest()`](#verify-user-mobile-change-request)                          | Confirm mobile change                          | `userId`, `request: ChangeUserMobileConfirmSchema`                      |
| [`getUserBankAccounts()`](#get-user-bank-accounts)                                               | Get user bank accounts                         | `userId`, `prefer`                                                      |
| [`createUserBankAccount()`](#create-user-bank-account)                                           | Create user bank account                       | `userId`, `request: UserCardsSchema`, `prefer`                          |
| [`verifyUserBankAccountOtp()`](#verify-user-bank-account-otp)                                    | Verify bank account OTP                        | `userId`, `request: UserCardsOtpSchema`                                 |
| [`verifyUserBankAccount()`](#verify-user-bank-account)                                           | Verify bank accounts                           | `userId`, `request: UserVerifyBankInformationSchema`                    |
| [`deleteUserBankAccount()`](#delete-user-bank-account)                                           | Delete bank account                            | `userId`, `bankAccountId`                                               |
| [`updateUserBankAccount()`](#update-user-bank-account)                                           | Update bank account                            | `bankAccountId`, `request: UpdateUserBankInformationSchema`             |
| [`updateUserVerification()`](#update-user-verification)                                          | Update user verification                       | `userId`, `request: UserVerificationSchema`                             |
| [`getCategoryAttributes()`](#get-category-attributes)                                            | Get category attributes                        | `categoryId`, `productId`, `vendorId`, `excludeMultiSelects`            |
| [`getCategories()`](#get-categories)                                                             | Get all categories                             | `None`                                                                  |
| [`getCategory()`](#get-category)                                                                 | Get specific category                          | `categoryId`                                                            |

## Examples

### Basic Setup

```php
use Basalam\BasalamClient;
use Basalam\Auth\PersonalToken;

$auth = new PersonalToken(
    token: "your_access_token",
    refreshToken: "your_refresh_token"
);
$client = new BasalamClient(auth: $auth);
```

### Create Vendor

```php
use Basalam\Core\Models\CreateVendorSchema;

function createVendorExample()
{
    global $client;
    
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

    return $vendor;
}
```

### Update Vendor

```php
use Basalam\Core\Models\UpdateVendorSchema;

function updateVendorExample()
{
    global $client;
    
    $updatedVendor = $client->updateVendor(
        vendorId: 456,
        request: new UpdateVendorSchema([
            'title' => "Updated Store Name",
            'summary' => "Updated description"
        ])
    );

    return $updatedVendor;
}
```

### Get Vendor

```php
function getVendorExample()
{
    global $client;
    
    $vendor = $client->getVendor(
        vendorId: 456,
        prefer: "return=minimal"
    );

    return $vendor;
}
```

### Get Default Shipping Methods

```php
function getDefaultShippingMethodsExample()
{
    global $client;
    
    $shippingMethods = $client->getDefaultShippingMethods();

    return $shippingMethods;
}
```

### Get Shipping Methods

```php
function getShippingMethodsExample()
{
    global $client;
    
    $shippingMethods = $client->getShippingMethods();

    return $shippingMethods;
}
```

### Get Working Shipping Methods

```php
function getWorkingShippingMethodsExample()
{
    global $client;
    
    $workingMethods = $client->getWorkingShippingMethods(
        vendorId: 456
    );

    return $workingMethods;
}
```

### Update Shipping Methods

```php
use Basalam\Core\Models\UpdateShippingMethodSchema;

function updateShippingMethodsExample()
{
    global $client;
    
    $updatedMethods = $client->updateShippingMethods(
        vendorId: 456,
        request: new UpdateShippingMethodSchema([
            'shipping_methods' => [
                [
                    "method_id" => 3198,
                    "is_customized" => true,
                    "base_cost" => 50000
                ]
            ]
        ])
    );

    return $updatedMethods;
}
```

### Get Vendor Products

```php
use Basalam\Core\Models\GetVendorProductsSchema;
use Basalam\Core\Models\ProductStatusInputEnum;

function getVendorProductsExample()
{
    global $client;
    
    $products = $client->getVendorProducts(
        vendorId: 456,
        queryParams: new GetVendorProductsSchema([
            'statuses' => [ProductStatusInputEnum::PUBLISHED],
            'page' => 1,
            'per_page' => 10
        ])
    );

    return $products;
}
```

### Update Vendor Status

```php
use Basalam\Core\Models\UpdateVendorStatusSchema;
use Basalam\Core\Models\VendorStatusInputEnum;

function updateVendorStatusExample()
{
    global $client;
    
    $statusUpdate = $client->updateVendorStatus(
        vendorId: 456,
        request: new UpdateVendorStatusSchema([
            'status' => VendorStatusInputEnum::SEMI_ACTIVE,
            'description' => "Vendor is Semi Active"
        ])
    );

    return $statusUpdate;
}
```

### Create Vendor Mobile Change Request

```php
use Basalam\Core\Models\ChangeVendorMobileRequestSchema;

function createVendorMobileChangeRequestExample()
{
    global $client;
    
    $result = $client->createVendorMobileChangeRequest(
        vendorId: 456,
        request: new ChangeVendorMobileRequestSchema([
            'mobile' => "09123456789"
        ])
    );

    return $result;
}
```

### Create Vendor Mobile Change Confirmation

```php
use Basalam\Core\Models\ChangeVendorMobileConfirmSchema;

function createVendorMobileChangeConfirmationExample()
{
    global $client;
    
    $result = $client->createVendorMobileChangeConfirmation(
        vendorId: 456,
        request: new ChangeVendorMobileConfirmSchema([
            'mobile' => "09123456789",
            'verification_code' => 123456
        ])
    );

    return $result;
}
```

### Create Product

```php
use Basalam\Core\Models\ProductRequestSchema;
use Basalam\Core\Models\ProductStatusInputEnum;
use Basalam\Core\Models\UnitTypeInputEnum;

function createProductExample()
{
    global $client;
    
    $request = new ProductRequestSchema([
        'name' => "Product 01",
        'description' => "The material of this product is very high quality and made of silk.",
        'category_id' => 238,
        'primary_price' => 100000,
        'weight' => 300,
        'package_weight' => 500,
        'stock' => 10,
        'status' => ProductStatusInputEnum::PUBLISHED,
        'unit_quantity' => 10,
        'unit_type' => UnitTypeInputEnum::NUMERIC
    ]);
    
    $product = $client->createProduct(
        vendorId: 456,
        request: $request,
        photoFiles: ["test1.png", "test2.png"]
    );

    return $product;
}
```

### Update Bulk Products

```php
use Basalam\Core\Models\BatchUpdateProductsRequest;
use Basalam\Core\Models\UpdateProductRequestItem;

function updateBulkProductsExample()
{
    global $client;
    
    $updatedProducts = $client->updateBulkProducts(
        vendorId: 456,
        request: new BatchUpdateProductsRequest([
            'data' => [
                new UpdateProductRequestItem([
                    'id' => 1,
                    'name' => "Updated Product 01",
                    'stock' => 25
                ]),
                new UpdateProductRequestItem([
                    'id' => 1,
                    'stock' => 5,
                    'primary_price' => 21000
                ])
            ]
        ])
    );

    return $updatedProducts;
}
```

### Update Product

```php
use Basalam\Core\Models\ProductRequestSchema;

function updateProductExample()
{
    global $client;
    
    $updatedProduct = $client->updateProduct(
        productId: 789,
        request: new ProductRequestSchema([
            'status' => 3790,
            'product_attribute' => [
                [
                    "attribute_id" => 219,
                    "value" => "Suitable for formal ceremonies"
                ],
                [
                    "attribute_id" => 221,
                    "value" => "Silk"
                ],
                [
                    "attribute_id" => 222,
                    "value" => "Burgundy, Black, Turquoise"
                ],
                [
                    "attribute_id" => 1319,
                    "value" => "Due to its sensitivity, this fabric should be hand washed gently with cold water."
                ]
            ]
        ])
    );

    return $updatedProduct;
}
```

> Use
>
this [API](https://developers.basalam.com/rest/core#/operations/read_category_attribute_v3_categories__category_id__attributes_get)
> to get a list of product attributes.

### Get Product

```php
function getProductExample()
{
    global $client;
    
    $product = $client->getProduct(
        productId: 24835037,
        prefer: "return=minimal"
    );

    return $product;
}
```

### Get Products

```php
use Basalam\Core\Models\GetProductsQuerySchema;

function getProductsExample()
{
    global $client;
    
    $products = $client->getProducts(
        queryParams: new GetProductsQuerySchema([
            'page' => 1,
            'per_page' => 20,
            'sort' => "price:asc"
        ])
    );

    return $products;
}
```

### Create Products Bulk Action Request

```php
use Basalam\Core\Models\BulkProductsUpdateRequestSchema;
use Basalam\Core\Models\ProductFilterSchema;
use Basalam\Core\Models\BulkActionItem;
use Basalam\Core\Models\RangeFilterItem;
use Basalam\Core\Models\ProductBulkActionTypeEnum;
use Basalam\Core\Models\ProductBulkFieldInputEnum;

function createProductsBulkActionRequestExample()
{
    global $client;
    
    $bulkRequest = $client->createProductsBulkActionRequest(
        vendorId: 456,
        request: new BulkProductsUpdateRequestSchema([
            'product_filter' => new ProductFilterSchema([
                'stock' => new RangeFilterItem([
                    'start' => 1,
                    'end' => 5
                ])
            ]),
            'action' => [
                new BulkActionItem([
                    'field' => ProductBulkFieldInputEnum::STOCK,
                    'action' => ProductBulkActionTypeEnum::SET,
                    'value' => 50
                ])
            ]
        ])
    );

    return $bulkRequest;
}
```

### Update Product Variation

```php
use Basalam\Core\Models\UpdateProductVariationSchema;

function updateProductVariationExample()
{
    global $client;
    
    $updatedVariation = $client->updateProductVariation(
        productId: 789,
        variationId: 6639697,
        request: new UpdateProductVariationSchema([
            'primary_price' => 150000,
            'stock' => 100
        ])
    );

    return $updatedVariation;
}
```

### Get Products Bulk Action Requests

```php
function getProductsBulkActionRequestsExample()
{
    global $client;
    
    $bulkRequests = $client->getProductsBulkActionRequests(
        vendorId: 456,
        page: 1,
        perPage: 30
    );

    return $bulkRequests;
}
```

### Get Products Bulk Action Requests Count

```php
function getProductsBulkActionRequestsCountExample()
{
    global $client;
    
    $counts = $client->getProductsBulkActionRequestsCount(
        vendorId: 456
    );

    return $counts;
}
```

### Get Products Unsuccessful Bulk Action Requests

```php
function getProductsUnsuccessfulBulkActionRequestsExample()
{
    global $client;
    
    $unsuccessfulProducts = $client->getProductsUnsuccessfulBulkActionRequests(
        requestId: 123
    );

    return $unsuccessfulProducts;
}
```

### Get Product Shelves

```php
function getProductShelvesExample()
{
    global $client;
    
    $shelves = $client->getProductShelves(
        productId: 789
    );

    return $shelves;
}
```

### Create Discount

```php
use Basalam\Core\Models\CreateDiscountRequestSchema;
use Basalam\Core\Models\DiscountProductFilterSchema;

function createDiscountExample()
{
    global $client;
    
    $discount = $client->createDiscount(
        vendorId: 456,
        request: new CreateDiscountRequestSchema([
            'product_filter' => new DiscountProductFilterSchema([
                'product_ids' => [25010883, 24835037]
            ]),
            'discount_percent' => 20,
            'active_days' => 5
        ])
    );

    return $discount;
}
```

### Delete Discount

```php
use Basalam\Core\Models\DeleteDiscountRequestSchema;
use Basalam\Core\Models\DiscountProductFilterSchema;

function deleteDiscountExample()
{
    global $client;
    
    $result = $client->createDiscount(
        vendorId: 456,
        request: new DeleteDiscountRequestSchema([
            'product_filter' => new DiscountProductFilterSchema([
                'product_ids' => [25010883]
            ])
        ])
    );

    return $result;
}
```

### Get Current User

```php
function getCurrentUserExample()
{
    global $client;
    
    $user = $client->getCurrentUser();

    return $user;
}
```

### Create User Mobile Confirmation Request

```php
function createUserMobileConfirmationRequestExample()
{
    global $client;
    
    $result = $client->createUserMobileConfirmationRequest(
        userId: 123
    );

    return $result;
}
```

### Verify User Mobile Confirmation Request

```php
use Basalam\Core\Models\ConfirmCurrentUserMobileConfirmSchema;

function verifyUserMobileConfirmationRequestExample()
{
    global $client;
    
    $result = $client->verifyUserMobileConfirmationRequest(
        userId: 123,
        request: new ConfirmCurrentUserMobileConfirmSchema([
            'verification_code' => 123456
        ])
    );

    return $result;
}
```

### Create User Mobile Change Request

```php
use Basalam\Core\Models\ChangeUserMobileRequestSchema;

function createUserMobileChangeRequestExample()
{
    global $client;
    
    $result = $client->createUserMobileChangeRequest(
        userId: 123,
        request: new ChangeUserMobileRequestSchema([
            'mobile' => "09123456789"
        ])
    );

    return $result;
}
```

### Verify User Mobile Change Request

```php
use Basalam\Core\Models\ChangeUserMobileConfirmSchema;

function verifyUserMobileChangeRequestExample()
{
    global $client;
    
    $result = $client->verifyUserMobileChangeRequest(
        userId: 123,
        request: new ChangeUserMobileConfirmSchema([
            'mobile' => "09123456789",
            'verification_code' => 123456
        ])
    );

    return $result;
}
```

### Get User Bank Accounts

```php
function getUserBankAccountsExample()
{
    global $client;
    
    $bankAccounts = $client->getUserBankAccounts(
        userId: 123
    );

    return $bankAccounts;
}
```

### Create User Bank Account

```php
use Basalam\Core\Models\UserCardsSchema;

function createUserBankAccountExample()
{
    global $client;
    
    $bankAccount = $client->createUserBankAccount(
        userId: 123,
        request: new UserCardsSchema([
            'card_number' => "1234567890123456"
        ])
    );

    return $bankAccount;
}
```

### Verify User Bank Account OTP

```php
use Basalam\Core\Models\UserCardsOtpSchema;

function verifyUserBankAccountOtpExample()
{
    global $client;
    
    $result = $client->verifyUserBankAccountOtp(
        userId: 123,
        request: new UserCardsOtpSchema([
            'card_number' => "1234567890123456",
            'otp_code' => "123456"
        ])
    );

    return $result;
}
```

### Verify User Bank Account

The `bank_information_id` is in the result of `verifyUserBankAccountOtp` that should pass to the
`verifyUserBankAccount` for verifying the new bank information just added.

```php
use Basalam\Core\Models\UserVerifyBankInformationSchema;

function verifyUserBankAccountExample()
{
    global $client;
    
    $result = $client->verifyUserBankAccount(
        userId: 123,
        request: new UserVerifyBankInformationSchema([
            'bank_information_id' => 1,
            'national_code' => "1234567890",
            'birthday' => "1990-01-01"
        ])
    );

    return $result;
}
```

### Delete User Bank Account

```php
function deleteUserBankAccountExample()
{
    global $client;
    
    $result = $client->deleteUserBankAccount(
        userId: 123,
        bankAccountId: 1
    );

    return $result;
}
```

### Update User Bank Account

```php
use Basalam\Core\Models\UpdateUserBankInformationSchema;

function updateUserBankAccountExample()
{
    global $client;
    
    $result = $client->updateUserBankAccount(
        bankAccountId: 1,
        request: new UpdateUserBankInformationSchema([
            'user_id' => 123
        ])
    );

    return $result;
}
```

### Update User Verification

```php
use Basalam\Core\Models\UserVerificationSchema;

function updateUserVerificationExample()
{
    global $client;
    
    $user = $client->updateUserVerification(
        userId: 123,
        request: new UserVerificationSchema([
            'national_code' => "1234567890",
            'birthday' => "1990-01-01"
        ])
    );

    return $user;
}
```

### Get Category Attributes

```php
function getCategoryAttributesExample()
{
    global $client;
    
    $attributes = $client->getCategoryAttributes(
        categoryId: 1066
    );

    return $attributes;
}
```

### Get Categories

```php
function getCategoriesExample()
{
    global $client;
    
    $categories = $client->getCategories();

    return $categories;
}
```

### Get Category

```php
function getCategoryExample()
{
    global $client;
    
    $category = $client->getCategory(
        categoryId: 1066
    );

    return $category;
}
```