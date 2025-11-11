<?php

namespace Basalam\Chat;

use Basalam\Auth\BaseAuth;
use Basalam\Chat\Models\BooleanResponse;
use Basalam\Chat\Models\BotApiResponse;
use Basalam\Chat\Models\ChatListResponse;
use Basalam\Chat\Models\CreateChatRequest;
use Basalam\Chat\Models\CreateChatResponse;
use Basalam\Chat\Models\DeleteChatRequest;
use Basalam\Chat\Models\DeleteMessageRequest;
use Basalam\Chat\Models\EditMessageRequest;
use Basalam\Chat\Models\ForwardMessageRequest;
use Basalam\Chat\Models\GetChatsRequest;
use Basalam\Chat\Models\GetMessagesRequest;
use Basalam\Chat\Models\GetMessagesResponse;
use Basalam\Chat\Models\MessageRequest;
use Basalam\Chat\Models\MessageResponse;
use Basalam\Chat\Models\UnseenChatCountResponse;
use Basalam\Config\Config;
use Basalam\Http\BaseClient;

class ChatService extends BaseClient
{
    public function __construct(BaseAuth $auth, ?Config $config = null)
    {
        parent::__construct($auth, $config, 'chat');
    }

    /**
     * Create a message
     *
     * @param MessageRequest $request
     * @param string|null $userAgent
     * @param string|null $xClientInfo
     * @return MessageResponse
     */
    public function createMessage(
        MessageRequest $request,
        ?string        $userAgent = null,
        ?string        $xClientInfo = null
    ): MessageResponse
    {
        $requestData = $request->toArray();
        $chatId = $requestData['chat_id'];
        $endpoint = "/v1/chats/{$chatId}/messages";
        $headers = [];

        if ($userAgent !== null) {
            $headers['User-Agent'] = $userAgent;
        }
        if ($xClientInfo !== null) {
            $headers['X-Client-Info'] = $xClientInfo;
        }

        $response = $this->post($endpoint, $request->toArray(), [], $headers);
        return MessageResponse::fromArray($response);
    }

    /**
     * Create a chat
     *
     * @param CreateChatRequest $request
     * @param string|null $xCreationTags
     * @param string|null $xUserSession
     * @param string|null $xClientInfo
     * @return CreateChatResponse
     */
    public function createChat(
        CreateChatRequest $request,
        ?string           $xCreationTags = null,
        ?string           $xUserSession = null,
        ?string           $xClientInfo = null
    ): CreateChatResponse
    {
        $endpoint = '/v1/chats';
        $headers = [];

        if ($xCreationTags !== null) {
            $headers['X-Creation-Tags'] = $xCreationTags;
        }
        if ($xUserSession !== null) {
            $headers['X-User-Session'] = $xUserSession;
        }
        if ($xClientInfo !== null) {
            $headers['X-Client-Info'] = $xClientInfo;
        }

        $response = $this->post($endpoint, $request->toArray(), [], $headers);
        return CreateChatResponse::fromArray($response);
    }

    /**
     * Get messages from a chat
     *
     * @param GetMessagesRequest $request
     * @return GetMessagesResponse
     */
    public function getMessages(GetMessagesRequest $request): GetMessagesResponse
    {
        $params = $request->toArray();
        $chatId = $params['chat_id'];
        $endpoint = "/v1/chats/{$chatId}/messages";

        $response = $this->get($endpoint, $params);
        return GetMessagesResponse::fromArray($response);
    }

    /**
     * Get chats list
     *
     * @param GetChatsRequest $request
     * @return ChatListResponse
     */
    public function getChats(GetChatsRequest $request): ChatListResponse
    {
        $endpoint = '/v1/chats';
        $params = $request->toArray();

        $response = $this->get($endpoint, $params);
        return ChatListResponse::fromArray($response);
    }

    /**
     * Edit a message
     *
     * @param EditMessageRequest $request
     * @param string|null $xClientInfo
     * @return MessageResponse
     */
    public function editMessage(
        EditMessageRequest $request,
        ?string            $xClientInfo = null
    ): MessageResponse
    {
        $endpoint = '/v1/chats/messages';
        $headers = [];

        if ($xClientInfo !== null) {
            $headers['X-Client-Info'] = $xClientInfo;
        }

        $response = $this->patch($endpoint, $request->toArray(), $headers);
        return MessageResponse::fromArray($response);
    }

    /**
     * Delete messages
     *
     * @param DeleteMessageRequest $request
     * @return BooleanResponse
     */
    public function deleteMessage(DeleteMessageRequest $request): BooleanResponse
    {
        $endpoint = '/v1/chats/messages';
        $response = $this->delete($endpoint, [], $request->toArray());
        return BooleanResponse::fromArray($response);
    }

    /**
     * Delete chats
     *
     * @param DeleteChatRequest $request
     * @return BooleanResponse
     */
    public function deleteChats(DeleteChatRequest $request): BooleanResponse
    {
        $endpoint = '/v1/chats';
        $response = $this->delete($endpoint, [], $request->toArray());
        return BooleanResponse::fromArray($response);
    }

    /**
     * Forward messages to other chats
     *
     * @param ForwardMessageRequest $request
     * @param string|null $userAgent
     * @param string|null $xClientInfo
     * @return BooleanResponse
     */
    public function forwardMessage(
        ForwardMessageRequest $request,
        ?string               $userAgent = null,
        ?string               $xClientInfo = null
    ): BooleanResponse
    {
        $endpoint = '/v1/chats/messages/forward';
        $headers = [];

        if ($userAgent !== null) {
            $headers['User-Agent'] = $userAgent;
        }
        if ($xClientInfo !== null) {
            $headers['X-Client-Info'] = $xClientInfo;
        }

        $response = $this->post($endpoint, $request->toArray(), [], $headers);
        return BooleanResponse::fromArray($response);
    }

    /**
     * Get unseen chat count
     *
     * @return UnseenChatCountResponse
     */
    public function getUnseenChatCount(): UnseenChatCountResponse
    {
        $endpoint = '/v1/chats/unseen-count';
        $response = $this->get($endpoint);
        return UnseenChatCountResponse::fromArray($response);
    }

    /**
     * Get webhook info (GET method)
     * Retrieves the current webhook information for the bot.
     *
     * @param string $token Bot token (format: {bot_id}:{token_string})
     * @return BotApiResponse
     */
    public function getWebhookInfo(string $token): BotApiResponse
    {
        $endpoint = "/v1/bots/{$token}/getWebhookInfo";
        $response = $this->get($endpoint);
        return BotApiResponse::fromArray($response);
    }

    /**
     * Get webhook info (POST method)
     * Retrieves the current webhook information for the bot.
     *
     * @param string $token Bot token (format: {bot_id}:{token_string})
     * @return BotApiResponse
     */
    public function getWebhookInfoPost(string $token): BotApiResponse
    {
        $endpoint = "/v1/bots/{$token}/getWebhookInfo";
        $response = $this->post($endpoint);
        return BotApiResponse::fromArray($response);
    }

    /**
     * Log out (GET method)
     * Logs out the bot and invalidates its token.
     *
     * @param string $token Bot token (format: {bot_id}:{token_string})
     * @return BotApiResponse
     */
    public function logOut(string $token): BotApiResponse
    {
        $endpoint = "/v1/bots/{$token}/logOut";
        $response = $this->get($endpoint);
        return BotApiResponse::fromArray($response);
    }

    /**
     * Log out (POST method)
     * Logs out the bot and invalidates its token.
     *
     * @param string $token Bot token (format: {bot_id}:{token_string})
     * @return BotApiResponse
     */
    public function logOutPost(string $token): BotApiResponse
    {
        $endpoint = "/v1/bots/{$token}/logOut";
        $response = $this->post($endpoint);
        return BotApiResponse::fromArray($response);
    }

    /**
     * Delete webhook (GET method)
     * Deletes the webhook URL for the bot.
     *
     * @param string $token Bot token (format: {bot_id}:{token_string})
     * @return BotApiResponse
     */
    public function deleteWebhookGet(string $token): BotApiResponse
    {
        $endpoint = "/v1/bots/{$token}/deleteWebhook";
        $response = $this->get($endpoint);
        return BotApiResponse::fromArray($response);
    }

    /**
     * Delete webhook (POST method)
     * Deletes the webhook URL for the bot.
     *
     * @param string $token Bot token (format: {bot_id}:{token_string})
     * @return BotApiResponse
     */
    public function deleteWebhookPost(string $token): BotApiResponse
    {
        $endpoint = "/v1/bots/{$token}/deleteWebhook";
        $response = $this->post($endpoint);
        return BotApiResponse::fromArray($response);
    }

    /**
     * Delete webhook (DELETE method)
     * Deletes the webhook URL for the bot.
     *
     * @param string $token Bot token (format: {bot_id}:{token_string})
     * @return BotApiResponse
     */
    public function deleteWebhookDelete(string $token): BotApiResponse
    {
        $endpoint = "/v1/bots/{$token}/deleteWebhook";
        $response = $this->delete($endpoint);
        return BotApiResponse::fromArray($response);
    }

    /**
     * Get bot information (GET method)
     * Returns information about the bot.
     *
     * @param string $token Bot token (format: {bot_id}:{token_string})
     * @return BotApiResponse
     */
    public function getMe(string $token): BotApiResponse
    {
        $endpoint = "/v1/bots/{$token}/getMe";
        $response = $this->get($endpoint);
        return BotApiResponse::fromArray($response);
    }

    /**
     * Get bot information (POST method)
     * Returns information about the bot.
     *
     * @param string $token Bot token (format: {bot_id}:{token_string})
     * @return BotApiResponse
     */
    public function getMePost(string $token): BotApiResponse
    {
        $endpoint = "/v1/bots/{$token}/getMe";
        $response = $this->post($endpoint);
        return BotApiResponse::fromArray($response);
    }
}