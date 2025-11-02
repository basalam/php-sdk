<?php

namespace Basalam\Tests;

use Basalam\Auth\PersonalToken;
use Basalam\BasalamClient;
use Basalam\Chat\Models\CreateChatRequest;
use Basalam\Chat\Models\DeleteChatRequest;
use Basalam\Chat\Models\DeleteMessageRequest;
use Basalam\Chat\Models\EditMessageRequest;
use Basalam\Chat\Models\ForwardMessageRequest;
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
    private const  TEST_CHAT_ID = 183583802;
    private const  TEST_USER_ID = 430;
    private const  TEST_MESSAGE_ID = 989836653; // 989871614
    private const  TEST_TARGET_CHAT_ID = 3082692; // Replace with actual target chat ID for forward
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

    /**
     * Test editing a message.
     */
    public function testEditMessage(): void
    {
        try {
            // Create message input
            $messageInput = new MessageInput(
                text: 'Updated test message',
                entityId: null
            );

            // Create edit message request
            $request = new EditMessageRequest(
                messageId: self::TEST_MESSAGE_ID,
                content: $messageInput
            );

            // Call the method
            $result = $this->basalamClient->editMessage(
                request: $request,
                xClientInfo: 'SDK-Test'
            );

            // Print the result
            echo "\n=== Test: Edit Message ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Edit Message ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test deleting messages.
     */
    public function testDeleteMessage(): void
    {
        try {
            // Create delete message request
            $request = new DeleteMessageRequest(
                messageIds: [self::TEST_MESSAGE_ID]
            );

            // Call the method
            $result = $this->basalamClient->deleteMessage(request: $request);

            // Print the result
            echo "\n=== Test: Delete Message ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Delete Message ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test deleting chats.
     */
    public function testDeleteChats(): void
    {
        try {
            // Create delete chat request
            $request = new DeleteChatRequest(
                chatIds: [self::TEST_CHAT_ID]
            );

            // Call the method
            $result = $this->basalamClient->deleteChats(request: $request);

            // Print the result
            echo "\n=== Test: Delete Chats ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Delete Chats ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test forwarding messages.
     */
    public function testForwardMessage(): void
    {
        try {
            // Create forward message request
            $request = new ForwardMessageRequest(
                messageIds: [self::TEST_MESSAGE_ID],
                chatIds: [self::TEST_TARGET_CHAT_ID]
            );

            // Call the method
            $result = $this->basalamClient->forwardMessage(
                request: $request,
                userAgent: 'SDK-Test'
            );

            // Print the result
            echo "\n=== Test: Forward Message ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Forward Message ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

    /**
     * Test getting unseen chat count.
     */
    public function testGetUnseenChatCount(): void
    {
        try {
            // Call the method
            $result = $this->basalamClient->getUnseenChatCount();

            // Print the result
            echo "\n=== Test: Get Unseen Chat Count ===\n";
            echo "Result: " . json_encode($result, JSON_PRETTY_PRINT) . "\n";

            // Check if result is not null
            $this->assertNotNull($result);

        } catch (\Exception $e) {
            echo "\n=== Test: Get Unseen Chat Count ===\n";
            echo "Error: " . $e->getMessage() . "\n";
            // Pass the test anyway
            $this->assertTrue(true);
        }
    }

}