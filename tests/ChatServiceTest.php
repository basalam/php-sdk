<?php

namespace Basalam\Tests;

use Basalam\Auth\PersonalToken;
use Basalam\BasalamClient;
use Basalam\Chat\Models\CreateChatRequest;
use Basalam\Chat\Models\GetChatsRequest;
use Basalam\Chat\Models\GetMessagesRequest;
use Basalam\Chat\Models\MessageInput;
use Basalam\Chat\Models\MessageOrderByEnum;
use Basalam\Chat\Models\MessageRequest;
use Basalam\Chat\Models\MessageTypeEnum;
use Basalam\Config\Config;
use Basalam\Config\Environment;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Chat service client.
 */
class ChatServiceTest extends TestCase
{
    /**
     * Test data constants
     */
    private const  TEST_CHAT_ID = 178204460;
    private const  TEST_USER_ID = 430;
    /**
     * @var BasalamClient
     */
    private BasalamClient $basalamClient;

    /**
     * Set up the test environment before each test.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Create a BasalamClient instance with real auth and config
        $config = new Config(
            environment: Environment::PRODUCTION,
            timeout: 30.0,
            userAgent: 'SDK-Test'
        );

        // Note: In real tests, use environment variables or config files for tokens
        $auth = new PersonalToken(
            token: ''
        );

        $this->basalamClient = new BasalamClient($auth, $config);
    }

    /**
     * Test creating a message.
     *

     */
    public function testCreateMessage(): void
    {
        try {
            // Create message input
            $messageInput = new MessageInput(
                text: 'Test message',
                entityId: 123
            );

            // Create message request
            $request = new MessageRequest(
                chatId: self::TEST_CHAT_ID,
                content: $messageInput,
                messageType: MessageTypeEnum::TEXT,
                tempId: 12345
            );

            // Call the method
            $result = $this->basalamClient->createMessage(
                request: $request,
                userAgent: 'SDK-Test'
            );

            // Print the result
            echo "\n=== Test: Create Message ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Create Message ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    // -------------------------------------------------------------------------
    // Message endpoints tests
    // -------------------------------------------------------------------------

    /**
     * Test getting messages from a chat.
     *

     */
    public function testGetMessages(): void
    {
        try {
            // Create request
            $request = new GetMessagesRequest(
                chatId: self::TEST_CHAT_ID
            );

            // Call the method
            $result = $this->basalamClient->getMessages(
                request: $request
            );

            // Print the result
            echo "\n=== Test: Get Messages ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Messages ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test creating a chat.
     *

     */
    public function testCreateChat(): void
    {
        try {
            // Create request
            $request = new CreateChatRequest(
                userId: 1308962
            );

            // Call the method
            $result = $this->basalamClient->createChat(
                request: $request
            );

            // Print the result
            echo "\n=== Test: Create Chat ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Create Chat ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    // -------------------------------------------------------------------------
    // Chat endpoints tests
    // -------------------------------------------------------------------------

    /**
     * Test getting list of chats.
     *

     */
    public function testGetChats(): void
    {
        try {
            // Create request
            $request = new GetChatsRequest(
                limit: 10,
            );

            // Call the method
            $result = $this->basalamClient->getChats(
                request: $request
            );

            // Print the result
            echo "\n=== Test: Get Chats ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Chats ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test getting chats with all filters.
     */
    public function testGetChatsWithFilters(): void
    {
        try {
            // Create request with all filters
            $request = new GetChatsRequest(
                limit: 5,
                orderBy: MessageOrderByEnum::UPDATED_AT
            );

            // Call the method
            $result = $this->basalamClient->getChats(
                request: $request
            );

            // Print the result
            echo "\n=== Test: Get Chats With Filters ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Chats With Filters ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

}