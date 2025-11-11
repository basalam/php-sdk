# Chat Service

Handle messaging and chat functionalities with the Chat Service. This service provides comprehensive tools for managing
conversations, messages, and chat interactions: create and manage chat conversations, send and retrieve messages, handle
different message types, manage chat participants, and track chat history and updates.

## Table of Contents

- [Chat Methods](#chat-methods)
- [Bot API Methods](#bot-api-methods)
- [Examples](#examples)

## Chat Methods

| Method                                       | Description                   | Parameters                                               |
|----------------------------------------------|-------------------------------|----------------------------------------------------------|
| [`createMessage()`](#create-message)         | Create a message              | `request: MessageRequest`, `userAgent`, `xClientInfo`    |
| [`createChat()`](#create-chat)               | Create a chat                 | `request: CreateChatRequest`, `xCreationTags`, etc.      |
| [`getMessages()`](#get-messages)             | Get chat messages             | `request: GetMessagesRequest`                            |
| [`getChats()`](#get-chats)                   | Get chats list                | `request: GetChatsRequest`                               |
| [`editMessage()`](#edit-message)             | Edit a message                | `request: EditMessageRequest`, `xClientInfo`             |
| [`deleteMessage()`](#delete-message)         | Delete messages               | `request: DeleteMessageRequest`                          |
| [`deleteChats()`](#delete-chats)             | Delete chats                  | `request: DeleteChatRequest`                             |
| [`forwardMessage()`](#forward-message)       | Forward messages to chats     | `request: ForwardMessageRequest`, `userAgent`, etc.      |
| [`getUnseenChatCount()`](#get-unseen-count)  | Get unseen chat count         | `None`                                                   |

## Bot API Methods

Bot API methods allow you to interact with bot-related functionality. All bot methods require a bot token in the format: `{bot_id}:{token_string}` (e.g., "123456789:ABCdefGHIjklMNOpqrsTUVwxyz").

| Method                                                 | Description                          | HTTP Method | Parameters        |
|--------------------------------------------------------|--------------------------------------|-------------|-------------------|
| [`getWebhookInfo()`](#get-webhook-info)                | Get webhook information              | GET         | `token: string`   |
| [`getWebhookInfoPost()`](#get-webhook-info-post)       | Get webhook information              | POST        | `token: string`   |
| [`logOut()`](#log-out)                                 | Log out bot and invalidate token     | GET         | `token: string`   |
| [`logOutPost()`](#log-out-post)                        | Log out bot and invalidate token     | POST        | `token: string`   |
| [`deleteWebhookGet()`](#delete-webhook-get)            | Delete webhook URL                   | GET         | `token: string`   |
| [`deleteWebhookPost()`](#delete-webhook-post)          | Delete webhook URL                   | POST        | `token: string`   |
| [`deleteWebhookDelete()`](#delete-webhook-delete)      | Delete webhook URL                   | DELETE      | `token: string`   |
| [`getMe()`](#get-me)                                   | Get bot information                  | GET         | `token: string`   |
| [`getMePost()`](#get-me-post)                          | Get bot information                  | POST        | `token: string`   |

All bot methods return `BotApiResponse` with the following properties:
- `ok` (bool) - Indicates if the request was successful
- `result` (mixed) - Detailed information about the bot or operation (if available)
- `description` (?string) - Description of the response or error
- `errorCode` (?int) - Error code if the request failed

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

### Create Message

```php
use Basalam\Chat\Models\MessageRequest;
use Basalam\Chat\Models\MessageTypeEnum;
use Basalam\Chat\Models\MessageInput;

function createMessageExample()
{
    global $client;
    
    $request = new MessageRequest([
        'chat_id' => 123,
        'message_type' => MessageTypeEnum::TEXT,
        'content' => new MessageInput([
            'text' => "Hello, how can I help you?"
        ])
    ]);
    $message = $client->createMessage(request: $request);
    return $message;
}
```

### Create Chat

```php
use Basalam\Chat\Models\CreateChatRequest;

function createChatExample()
{
    global $client;
    
    $request = new CreateChatRequest([
        'user_id' => 123
    ]);
    $newChat = $client->createChat(request: $request);
    return $newChat;
}
```

### Get Messages

```php
use Basalam\Chat\Models\GetMessagesRequest;

function getMessagesExample()
{
    global $client;
    
    $request = new GetMessagesRequest([
        'chat_id' => 123,
        'message_id' => 456,
        'limit' => 20,
        'order' => "desc"
    ]);
    $messages = $client->getMessages(request: $request);
    return $messages;
}
```

### Get Chats

```php
use Basalam\Chat\Models\GetChatsRequest;
use Basalam\Chat\Models\MessageOrderByEnum;
use Basalam\Chat\Models\MessageFiltersEnum;

function getChatsExample()
{
    global $client;

    $request = new GetChatsRequest([
        'limit' => 30,
        'order_by' => MessageOrderByEnum::UPDATED_AT,
        'filters' => MessageFiltersEnum::UNSEEN
    ]);
    $chats = $client->getChats(request: $request);
    return $chats;
}
```

### Edit Message

```php
use Basalam\Chat\Models\EditMessageRequest;
use Basalam\Chat\Models\MessageInput;

function editMessageExample()
{
    global $client;

    $request = new EditMessageRequest([
        'chat_id' => 123,
        'message_id' => 456,
        'content' => new MessageInput([
            'text' => "Updated message text"
        ])
    ]);
    $editedMessage = $client->editMessage(
        request: $request,
        xClientInfo: "web-app"
    );
    return $editedMessage;
}
```

### Delete Message

```php
use Basalam\Chat\Models\DeleteMessageRequest;

function deleteMessageExample()
{
    global $client;

    $request = new DeleteMessageRequest([
        'chat_id' => 123,
        'message_ids' => [456, 457, 458]
    ]);
    $result = $client->deleteMessage(request: $request);
    return $result;
}
```

### Delete Chats

```php
use Basalam\Chat\Models\DeleteChatRequest;

function deleteChatsExample()
{
    global $client;

    $request = new DeleteChatRequest([
        'chat_ids' => [123, 124, 125]
    ]);
    $result = $client->deleteChats(request: $request);
    return $result;
}
```

### Forward Message

```php
use Basalam\Chat\Models\ForwardMessageRequest;

function forwardMessageExample()
{
    global $client;

    $request = new ForwardMessageRequest([
        'from_chat_id' => 123,
        'message_ids' => [456, 457],
        'to_chat_ids' => [124, 125]
    ]);
    $result = $client->forwardMessage(
        request: $request,
        userAgent: "Mozilla/5.0",
        xClientInfo: "web-app"
    );
    return $result;
}
```

### Get Unseen Chat Count

```php
function getUnseenChatCountExample()
{
    global $client;

    $unseenCount = $client->getUnseenChatCount();
    return $unseenCount;
}
```

### Get Webhook Info

Retrieve the current webhook information for a bot using GET method:

```php
function getWebhookInfoExample()
{
    global $client;

    $botToken = "123456789:ABCdefGHIjklMNOpqrsTUVwxyz";
    $webhookInfo = $client->getWebhookInfo(token: $botToken);

    if ($webhookInfo->getOk()) {
        echo "Webhook URL: " . $webhookInfo->getResult()['url'] ?? 'Not set';
    }

    return $webhookInfo;
}
```

Or use POST method:

```php
function getWebhookInfoPostExample()
{
    global $client;

    $botToken = "123456789:ABCdefGHIjklMNOpqrsTUVwxyz";
    $webhookInfo = $client->getWebhookInfoPost(token: $botToken);

    return $webhookInfo;
}
```

### Log Out

Log out the bot and invalidate its token using GET method:

```php
function logOutExample()
{
    global $client;

    $botToken = "123456789:ABCdefGHIjklMNOpqrsTUVwxyz";
    $result = $client->logOut(token: $botToken);

    if ($result->getOk()) {
        echo "Bot logged out successfully";
    } else {
        echo "Error: " . $result->getDescription();
    }

    return $result;
}
```

Or use POST method:

```php
function logOutPostExample()
{
    global $client;

    $botToken = "123456789:ABCdefGHIjklMNOpqrsTUVwxyz";
    $result = $client->logOutPost(token: $botToken);

    return $result;
}
```

### Delete Webhook

Delete the webhook URL for a bot using GET method:

```php
function deleteWebhookGetExample()
{
    global $client;

    $botToken = "123456789:ABCdefGHIjklMNOpqrsTUVwxyz";
    $result = $client->deleteWebhookGet(token: $botToken);

    if ($result->getOk()) {
        echo "Webhook deleted successfully";
    }

    return $result;
}
```

Or use POST method:

```php
function deleteWebhookPostExample()
{
    global $client;

    $botToken = "123456789:ABCdefGHIjklMNOpqrsTUVwxyz";
    $result = $client->deleteWebhookPost(token: $botToken);

    return $result;
}
```

Or use DELETE method (recommended):

```php
function deleteWebhookDeleteExample()
{
    global $client;

    $botToken = "123456789:ABCdefGHIjklMNOpqrsTUVwxyz";
    $result = $client->deleteWebhookDelete(token: $botToken);

    return $result;
}
```

### Get Me

Get information about the bot using GET method:

```php
function getMeExample()
{
    global $client;

    $botToken = "123456789:ABCdefGHIjklMNOpqrsTUVwxyz";
    $botInfo = $client->getMe(token: $botToken);

    if ($botInfo->getOk()) {
        $bot = $botInfo->getResult();
        echo "Bot ID: " . $bot['id'];
        echo "Bot Name: " . $bot['first_name'];
        echo "Bot Username: @" . $bot['username'];
    }

    return $botInfo;
}
```

Or use POST method:

```php
function getMePostExample()
{
    global $client;

    $botToken = "123456789:ABCdefGHIjklMNOpqrsTUVwxyz";
    $botInfo = $client->getMePost(token: $botToken);

    return $botInfo;
}
```

### Working with BotApiResponse

All bot methods return a `BotApiResponse` object. Here's how to work with the response:

```php
function handleBotResponseExample()
{
    global $client;

    $botToken = "123456789:ABCdefGHIjklMNOpqrsTUVwxyz";
    $response = $client->getMe(token: $botToken);

    // Check if request was successful
    if ($response->getOk()) {
        // Access the result data
        $botData = $response->getResult();
        echo "Success! Bot ID: " . $botData['id'];
    } else {
        // Handle error
        echo "Error Code: " . $response->getErrorCode();
        echo "Error Description: " . $response->getDescription();
    }

    // You can also convert to array
    $responseArray = $response->toArray();

    return $response;
}
```

## Message Types

The Chat Service supports various message types (see `MessageTypeEnum`):

- `file` - File attachments
- `product` - Product Card
- `vendor` - Vendor
- `text` - Plain text messages
- `picture` - Image messages (URL or file)
- `voice` - Audio messages
- `video` - Video messages
- `location` - Location sharing

## Next Steps

- [Order Service](./order.md) - Manage orders and payments
- [Upload Service](./upload.md) - File upload and management
- [Search Service](./search.md) - Search for products and entities