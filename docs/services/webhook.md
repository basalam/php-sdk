# Webhook Service

With the Webhook Service, you can receive real-time notifications about events related to your Basalam account. It
allows you to create and manage webhook subscriptions, handle various event types, monitor logs and delivery statuses,
and manage client registration and unregistration.

## Table of Contents

- [Webhook Methods](#webhook-methods)
- [Examples](#examples)

## Webhook Methods

| Method                                                | Description                         | Parameters                     |
|-------------------------------------------------------|-------------------------------------|--------------------------------|
| [`getWebhookServices()`](#get-webhook-services)       | Get webhook services                | `None`                         |
| [`createWebhookService()`](#create-webhook-service)   | Create a new webhook service        | `request`                      |
| [`getWebhooks()`](#get-webhooks)                      | Get list of webhooks                | `serviceId`, `eventIds`        |
| [`createWebhook()`](#create-webhook)                  | Create a new webhook                | `request`                      |
| [`updateWebhook()`](#update-webhook)                  | Update a webhook                    | `webhookId`, `request`         |
| [`deleteWebhook()`](#delete-webhook)                  | Delete a webhook                    | `webhookId`                    |
| [`getWebhookEvents()`](#get-webhook-events)           | Get available webhook events        | `None`                         |
| [`getWebhookCustomers()`](#get-webhook-customers)     | Get customers subscribed to webhook | `page`, `perPage`, `webhookId` |
| [`getWebhookLogs()`](#get-webhook-logs)               | Get webhook logs                    | `webhookId`                    |
| [`registerWebhook()`](#register-webhook)              | Register customer to webhook        | `request`                      |
| [`unregisterWebhook()`](#unregister-webhook)          | Unregister customer from webhook    | `request`                      |
| [`getRegisteredWebhooks()`](#get-registered-webhooks) | Get webhooks registered by customer | `page`, `perPage`, `serviceId` |

## Examples

### Initial Configuration

```php
use Basalam\BasalamClient;
use Basalam\Auth\PersonalToken;

$auth = new PersonalToken(
    token: "your_access_token",
    refreshToken: "your_refresh_token"
);
$client = new BasalamClient(auth: $auth);
```

### Get Webhook Services

```php
function getWebhookServicesExample()
{
    global $client;
    
    $services = $client->getWebhookServices();
    return $services;
}
```

### Create Webhook Service

```php
use Basalam\Webhook\Models\CreateServiceRequest;

function createWebhookServiceExample()
{
    global $client;
    
    $service = $client->createWebhookService(
        request: new CreateServiceRequest([
            'title' => "My Webhook Service",
            'description' => "Service for handling order notifications"
        ])
    );
    return $service;
}
```

### Get Webhooks

```php
function getWebhooksExample()
{
    global $client;
    
    $webhooks = $client->getWebhooks(
        serviceId: 1,
        eventIds: "1,2,3"
    );
    return $webhooks;
}
```

### Create Webhook

```php
use Basalam\Webhook\Models\CreateWebhookRequest;
use Basalam\Webhook\Models\RequestMethodType;

function createWebhookExample()
{
    global $client;
    
    $webhook = $client->createWebhook(
        request: new CreateWebhookRequest([
            'service_id' => 1,
            'event_ids' => [1, 2],
            'request_headers' => "Content-Type: application/json",
            'request_method' => RequestMethodType::POST,
            'url' => "https://your-app.com/webhook",
            'is_active' => true
        ])
    );
    return $webhook;
}
```

### Update Webhook

```php
use Basalam\Webhook\Models\UpdateWebhookRequest;
use Basalam\Webhook\Models\RequestMethodType;

function updateWebhookExample()
{
    global $client;
    
    $updatedWebhook = $client->updateWebhook(
        webhookId: 123,
        request: new UpdateWebhookRequest([
            'event_ids' => [1, 2, 3],
            'request_headers' => "Content-Type: application/json",
            'request_method' => RequestMethodType::POST,
            'url' => "https://your-app.com/webhook",
            'is_active' => false
        ])
    );
    return $updatedWebhook;
}
```

### Delete Webhook

```php
function deleteWebhookExample()
{
    global $client;
    
    $result = $client->deleteWebhook(webhookId: 123);
    return $result;
}
```

### Get Webhook Events

```php
function getWebhookEventsExample()
{
    global $client;
    
    $events = $client->getWebhookEvents();
    return $events;
}
```

Sample Response:

```php
EventListResource(
  data: [
    EventResource(
      id: 1,
      name: 'CHAT_RECEIVED_MESSAGE',
      description: 'Message received in Basalam chat',
      sampleData: [
        'id' => 0,
        'chat_id' => 0,
        'message' => [
          'text' => 'string',
          'files' => [
            ['id' => 0, 'url' => 'string', 'width' => 0, 'height' => 0]
          ],
          'links' => [],
          'entity_id' => 0
        ],
        'seen_at' => null,
        'sender_id' => 0,
        'created_at' => 'string',
        'updated_at' => 'string',
        'message_type' => MessageTypeEnum::TEXT,
        'message_source' => null
      ],
      scopes: 'customer.chat.read'
    )
  ],
  resultCount: 9,
  totalCount: null,
  totalPage: null,
  page: 1,
  perPage: 10
)
```

Refer to [this document](https://developers.basalam.com/services/webhook) to review required scopes for each event.

### Get Webhook Customers

```php
function getWebhookCustomersExample()
{
    global $client;
    
    $customers = $client->getWebhookCustomers(
        page: 1,
        perPage: 10,
        webhookId: 123
    );
    return $customers;
}
```

### Get Webhook Logs

```php
function getWebhookLogsExample()
{
    global $client;
    
    $logs = $client->getWebhookLogs(webhookId: 123);
    return $logs;
}
```

### Register Customer to Webhook

```php
use Basalam\Webhook\Models\RegisterClientRequest;

function registerWebhookExample()
{
    global $client;
    
    $result = $client->registerWebhook(
        request: new RegisterClientRequest([
            'webhook_id' => 123
        ])
    );
    return $result;
}
```

### Unregister Customer from Webhook

```php
use Basalam\Webhook\Models\UnRegisterClientRequest;

function unregisterWebhookExample()
{
    global $client;
    
    $result = $client->unregisterWebhook(
        request: new UnRegisterClientRequest([
            'webhook_id' => 123,
            'customer_id' => 456
        ])
    );
    return $result;
}
```

### Get Registered Webhooks

```php
function getRegisteredWebhooksExample()
{
    global $client;
    
    $webhooks = $client->getRegisteredWebhooks(
        page: 1,
        perPage: 10,
        serviceId: 1
    );
    return $webhooks;
}
```