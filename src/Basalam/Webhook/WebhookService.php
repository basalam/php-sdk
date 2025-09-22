<?php

namespace Basalam\Webhook;

use Basalam\Auth\BaseAuth;
use Basalam\Config\Config;
use Basalam\Http\BaseClient;
use Basalam\Webhook\Models\ClientListResource;
use Basalam\Webhook\Models\ClientResource;
use Basalam\Webhook\Models\CreateServiceRequest;
use Basalam\Webhook\Models\CreateWebhookRequest;
use Basalam\Webhook\Models\DeleteWebhookResponse;
use Basalam\Webhook\Models\EventListResource;
use Basalam\Webhook\Models\RegisterClientRequest;
use Basalam\Webhook\Models\ServiceListResource;
use Basalam\Webhook\Models\ServiceResource;
use Basalam\Webhook\Models\UnRegisterClientRequest;
use Basalam\Webhook\Models\UnRegisterClientResponse;
use Basalam\Webhook\Models\UpdateWebhookRequest;
use Basalam\Webhook\Models\WebhookListResource;
use Basalam\Webhook\Models\WebhookLogListResource;
use Basalam\Webhook\Models\WebhookRegisteredOnListResource;
use Basalam\Webhook\Models\WebhookResource;

/**
 * Client for the Webhook service API.
 */
class WebhookService extends BaseClient
{
    public function __construct(BaseAuth $auth, ?Config $config = null)
    {
        parent::__construct($auth, $config, 'webhook');
    }

    /**
     * Get a list of webhook services.
     *
     * @return ServiceListResource The response containing the list of services
     */
    public function getWebhookServices(): ServiceListResource
    {
        $endpoint = '/v1/services';
        $response = $this->get($endpoint);
        return ServiceListResource::fromArray($response);
    }

    /**
     * Create a new webhook service.
     *
     * @param CreateServiceRequest $request The service creation request
     * @return ServiceResource The created service resource
     */
    public function createWebhookService(CreateServiceRequest $request): ServiceResource
    {
        $endpoint = '/v1/services';
        $response = $this->post($endpoint, $request->toArray());
        return ServiceResource::fromArray($response);
    }

    /**
     * Get a list of webhooks.
     *
     * @param int|null $serviceId Optional service ID to filter by
     * @param string|null $eventIds Optional comma-separated list of event IDs to filter by
     * @return WebhookListResource The response containing the list of webhooks
     */
    public function getWebhooks(?int $serviceId = null, ?string $eventIds = null): WebhookListResource
    {
        $endpoint = '/v1/webhooks';
        $params = [];

        if ($serviceId !== null) {
            $params['service_id'] = $serviceId;
        }
        if ($eventIds !== null) {
            $params['event_ids'] = $eventIds;
        }

        $response = $this->get($endpoint, $params);
        return WebhookListResource::fromArray($response);
    }

    /**
     * Create a new webhook.
     *
     * @param CreateWebhookRequest $request The webhook creation request
     * @return WebhookResource The created webhook resource
     */
    public function createWebhook(CreateWebhookRequest $request): WebhookResource
    {
        $endpoint = '/v1/webhooks';
        $response = $this->post($endpoint, $request->toArray());
        return WebhookResource::fromArray($response);
    }

    /**
     * Get a list of webhook events.
     *
     * @return EventListResource The response containing the list of events
     */
    public function getWebhookEvents(): EventListResource
    {
        $endpoint = '/v1/webhooks/events';
        $response = $this->get($endpoint);
        return EventListResource::fromArray($response);
    }

    /**
     * Get a list of webhook customers.
     *
     * @param int|null $page Page number for pagination
     * @param int|null $perPage Number of items per page
     * @param int|null $webhookId Optional webhook ID to filter by
     * @return ClientListResource The response containing the list of customers
     */
    public function getWebhookCustomers(
        ?int $page = 1,
        ?int $perPage = 10,
        ?int $webhookId = null
    ): ClientListResource
    {
        $endpoint = '/v1/webhooks/customers';
        $params = [
            'page' => $page,
            'per_page' => $perPage,
        ];

        if ($webhookId !== null) {
            $params['webhook_id'] = $webhookId;
        }

        $response = $this->get($endpoint, $params);
        return ClientListResource::fromArray($response);
    }

    /**
     * Update a webhook.
     *
     * @param int $webhookId The ID of the webhook to update
     * @param UpdateWebhookRequest $request The update request
     * @return WebhookResource The updated webhook resource
     */
    public function updateWebhook(int $webhookId, UpdateWebhookRequest $request): WebhookResource
    {
        $endpoint = "/v1/webhooks/$webhookId";
        $response = $this->patch($endpoint, $request->toArray());
        return WebhookResource::fromArray($response);
    }

    /**
     * Delete a webhook.
     *
     * @param int $webhookId The ID of the webhook to delete
     * @return DeleteWebhookResponse The deletion response
     */
    public function deleteWebhook(int $webhookId): DeleteWebhookResponse
    {
        $endpoint = "/v1/webhooks/$webhookId";
        $response = $this->delete($endpoint);
        return DeleteWebhookResponse::fromArray($response);
    }

    /**
     * Get logs for a webhook.
     *
     * @param int $webhookId The ID of the webhook to get logs for
     * @return WebhookLogListResource The response containing the webhook logs
     */
    public function getWebhookLogs(int $webhookId): WebhookLogListResource
    {
        $endpoint = "/v1/webhooks/$webhookId/logs";
        $response = $this->get($endpoint);
        return WebhookLogListResource::fromArray($response);
    }

    /**
     * Register a client to a webhook.
     *
     * @param RegisterClientRequest $request The registration request
     * @return ClientResource The created client resource
     */
    public function registerWebhook(RegisterClientRequest $request): ClientResource
    {
        $endpoint = '/v1/customers/webhooks';
        $response = $this->post($endpoint, $request->toArray());
        return ClientResource::fromArray($response);
    }

    /**
     * Unregister a customer from a webhook.
     *
     * @param UnRegisterClientRequest $request The unregistration request
     * @return UnRegisterClientResponse The unregistration response
     */
    public function unregisterWebhook(UnRegisterClientRequest $request): UnRegisterClientResponse
    {
        $endpoint = '/v1/customers/webhooks';
        $response = $this->delete($endpoint, [], $request->toArray());
        return UnRegisterClientResponse::fromArray($response);
    }

    /**
     * Get webhooks that the customer is registered on.
     *
     * @param int|null $page Page number for pagination
     * @param int|null $perPage Number of items per page
     * @param int|null $serviceId Optional service ID to filter by
     * @return WebhookRegisteredOnListResource The response containing the list of registered webhooks
     */
    public function getRegisteredWebhooks(
        ?int $page = 1,
        ?int $perPage = 10,
        ?int $serviceId = null
    ): WebhookRegisteredOnListResource
    {
        $endpoint = '/v1/customers/webhooks';
        $params = [
            'page' => $page,
            'per_page' => $perPage,
        ];

        if ($serviceId !== null) {
            $params['service_id'] = $serviceId;
        }

        $response = $this->get($endpoint, $params);
        return WebhookRegisteredOnListResource::fromArray($response);
    }
}