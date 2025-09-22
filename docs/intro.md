# Introduction

Welcome to the Basalam PHP SDK – a comprehensive library for interacting with Basalam service APIs. This SDK provides
a simple, clean, and developer-friendly interface to all Basalam services. It is designed
to make integration with Basalam services as straightforward and efficient as possible. Whether you're building
server-to-server communication or developing a user-facing application, this SDK offers the tools you need.

**Supported PHP Versions:**  
`PHP 8.0+, PHP 8.1+, PHP 8.2+, PHP 8.3+`

**Key Features:**

- **Comprehensive Service Coverage**: Access to all Basalam services, including Wallet, Orders, Chat, and more.
- **Multiple Authentication Methods**: Supports Client Credentials, Authorization Code Flow, and Personal Access
  Tokens (PAT).
- **Data Type Safety**: Uses strict typing and model classes for data validation and type checking.
- **Error Management**: Detailed error classes for different error types.
- **Developer Friendly**: Clean and standard API design with full and clear documentation.

## Table of Contents

- [Installation](#installation)
- [Quick Start](#quick-start)
- [Authentication Methods](#authentication-methods)
- [Service Overview](#service-overview)

## Installation

Install the SDK using composer:

```bash
composer require basalam/php-sdk
```

## Quick Start

### 1. Configure Authentication

```php
use Basalam\BasalamClient;
use Basalam\Auth\PersonalToken;

// Personal Access Token (PAT)
$auth = new PersonalToken(
    token: "your-access-token",
    refreshToken: "your-refresh-token"
);

// Create client
$client = new BasalamClient(auth: $auth);
```

### 2. Your First API Calls

#### Get Products

```php
// Get products
function getProductsExample()
{
    global $client;
    
    $products = $client->getProducts();
    return $products;
}
```

#### Send a Message and Fetch Chats

```php
// Send a message
use Basalam\Chat\Models\MessageRequest;
use Basalam\Chat\Models\MessageTypeEnum;

function chatExample()
{
    global $client;
    
    $message = $client->createMessage(
        request: new MessageRequest([
            'chat_id' => 123,
            'content' => "Hello, how can I help you?",
            'message_type' => MessageTypeEnum::TEXT
        ])
    );
    
    // Get messages from a chat
    $messages = $client->getMessages(
        chatId: 123
    );
    return [$message, $messages];
}
```

## Service Overview

The Basalam PHP SDK supports all resource endpoints for the following services:

- **Core Service (User, Booth, Product)** – Vendors, products, shipping methods, and user information
- **Order Service** – Manage baskets, payments, and invoices
- **Order Tracking Service** – Customer and vendor orders
- **Wallet Service** – Handle balances, expenses, and refunds
- **Chat Service** – Messaging and conversation functionality
- **Upload Service** – File uploads
- **Search Service** – Product and entity search
- **Webhook Service** – Manage events and webhooks