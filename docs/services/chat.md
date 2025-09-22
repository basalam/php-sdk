# Chat Service

Handle messaging and chat functionalities with the Chat Service. This service provides comprehensive tools for managing
conversations, messages, and chat interactions: create and manage chat conversations, send and retrieve messages, handle
different message types, manage chat participants, and track chat history and updates.

## Table of Contents

- [Chat Methods](#chat-methods)
- [Examples](#examples)

## Chat Methods

| Method                               | Description       | Parameters                    |
|--------------------------------------|-------------------|-------------------------------|
| [`createMessage()`](#create-message) | Create a message  | `request: MessageRequest`     |
| [`createChat()`](#create-chat)       | Create a chat     | `request: CreateChatRequest`  |
| [`getMessages()`](#get-messages)     | Get chat messages | `request: GetMessagesRequest` |
| [`getChats()`](#get-chats)           | Get chats list    | `request: GetChatsRequest`    |

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