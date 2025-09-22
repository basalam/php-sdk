# Order Processing Service

Manage customer orders, vendor parcels, and the entire order lifecycle with the Order Processing Service. This service
provides comprehensive functionality to get and manage customer orders, track order items and details, handle vendor
parcels and shipping, generate order statistics, and monitor order status and updates.

## Table of Contents

- [Order Processing Methods](#order-processing-methods)
- [Examples](#examples)

## Order Processing Methods

| Method                                            | Description          | Parameters                                                                           |
|---------------------------------------------------|----------------------|--------------------------------------------------------------------------------------|
| [`getCustomerOrders()`](#get-orders)              | Get orders           | `filters` (OrderFilter)                                                              |
| [`getCustomerOrder()`](#get-order)                | Get specific order   | `orderId`                                                                            |
| [`getCustomerOrderItems()`](#get-order-items)     | Get order items      | `filters` (ItemFilter)                                                               |
| [`getCustomerOrderItem()`](#get-order-item)       | Get specific item    | `itemId`                                                                             |
| [`getVendorOrdersParcels()`](#get-orders-parcels) | Get orders parcels   | `filters` (OrderParcelFilter)                                                        |
| [`getOrderParcel()`](#get-order-parcel)           | Get specific parcel  | `parcelId`                                                                           |
| [`getOrdersStats()`](#get-order-stats)            | Get order statistics | `resourceCount`, `vendorId`, `productId`, `customerId`, `couponCode`, `cacheControl` |

## Examples

### Basic Setup

```php
use Basalam\BasalamClient;
use Basalam\Auth\PersonalToken;
use Basalam\OrderProcessing\Models\OrderFilter;
use Basalam\OrderProcessing\Models\ItemFilter;
use Basalam\OrderProcessing\Models\OrderParcelFilter;
use Basalam\OrderProcessing\Models\ResourceStats;

$auth = new PersonalToken(
    token: "your_access_token",
    refreshToken: "your_refresh_token"
);
$client = new BasalamClient(auth: $auth);
```

### Get Orders

```php
function getCustomerOrdersExample()
{
    global $client;
    
    $orders = $client->getCustomerOrders(
        filters: new OrderFilter([
            'coupon_code' => "SAVE10",
            'cursor' => "next_cursor_123",
            'customer_ids' => "123,456,789",
            'customer_name' => "John Doe",
            'ids' => "1,2,3",
            'items_title' => "laptop",
            'paid_at' => "2024-01-01",
            'parcel_estimate_send_at' => "2024-01-15",
            'parcel_statuses' => ["posted", "delivered"],
            'per_page' => 20,
            'product_ids' => "1,2,3",
            'sort' => "paid_at:desc",
            'vendor_ids' => "456,789"
        ])
    );
    
    return $orders;
}
```

### Get Order

```php
function getOrderExample()
{
    global $client;
    
    $order = $client->getOrder(
        orderId: 123
    );
 
    return $order;
}
```

### Get Order Items

```php
function getCustomerOrderItemsExample()
{
    global $client;
    
    $items = $client->getCustomerOrderItems(
        filters: new ItemFilter([
            'created_at' => "2024-01-01",
            'cursor' => "next_cursor_123",
            'customer_ids' => "123,456,789",
            'ids' => "1,2,3",
            'order_ids' => "1,2,3",
            'per_page' => 20,
            'product_ids' => "1,2,3",
            'sort' => "created_at:desc",
            'vendor_ids' => "456,789"
        ])
    );
    
    return $items;
}
```

### Get Order Item

```php
function getCustomerOrderItemExample()
{
    global $client;
    
    $item = $client->getCustomerOrderItem(
        itemId: 456
    );
    
    return $item;
}
```

### Get Orders Parcels

```php
function getVendorOrdersParcelsExample()
{
    global $client;
    
    $parcels = $client->getVendorOrdersParcels(
        filters: new OrderParcelFilter([
            'created_at' => "2024-01-01",
            'cursor' => "next_cursor_123",
            'estimate_send_at' => "2024-01-15",
            'ids' => "1,2,3",
            'items_customer_ids' => "123,456,789",
            'items_order_ids' => "1,2,3",
            'items_product_ids' => ["1", "2", "3"],
            'items_vendor_ids' => ["456", "789"],
            'per_page' => 20,
            'sort' => "estimate_send_at:desc",
            'statuses' => [3739, 3237, 3238]  // ParcelStatus enum values
        ])
    );
    
    return $parcels;
}
```

### Get Order Parcel

```php
function getOrderParcelExample()
{
    global $client;
    
    $parcel = $client->getOrderParcel(
        parcelId: 789
    );
    
    return $parcel;
}
```

### Get Order Stats

```php
function getOrdersStatsExample()
{
    global $client;
    
    $stats = $client->getOrdersStats(
        resourceCount: ResourceStats::NUMBER_OF_ORDERS_PER_VENDOR,
        vendorId: 456,
        productId: 123,
        customerId: 789,
        couponCode: "SAVE10",
        cacheControl: "no-cache"
    );
    
    return $stats;
}
```

## Order Statuses

Common order statuses include:

- `pending` - Order is pending
- `confirmed` - Order is confirmed
- `processing` - Order is being processed
- `shipped` - Order has been shipped
- `delivered` - Order has been delivered
- `cancelled` - Order was cancelled
- `refunded` - Order was refunded

## Parcel Statuses

Common parcel statuses include:

- `pending` - Parcel is pending
- `preparing` - Parcel is being prepared
- `shipped` - Parcel has been shipped
- `in_transit` - Parcel is in transit
- `delivered` - Parcel has been delivered
- `returned` - Parcel was returned

## Next Steps

- [Core Service](./core.md) - Manage vendors, products, and users