<?php

namespace Basalam\Apps;

use Basalam\Auth\BaseAuth;
use Basalam\Config\Config;
use Basalam\Http\BaseClient;
use Basalam\Apps\Models\CreatePreTransactionRequest;
use Basalam\Apps\Models\PlanListResource;
use Basalam\Apps\Models\PlanSubscriptionListResource;
use Basalam\Apps\Models\PlanSubscriptionResource;
use Basalam\Apps\Models\PreTransactionResource;
use Basalam\Apps\Models\TransactionListResource;
use Basalam\Apps\Models\TransactionPublicResource;

/**
 * Client for the Basalam Apps service API.
 */
class AppsService extends BaseClient
{
    public function __construct(BaseAuth $auth, ?Config $config = null)
    {
        parent::__construct($auth, $config, 'apps');
    }

    /**
     * لیست روش‌های پرداخت.
     *
     * @param bool|null $includeDisabled include_disabled
     * @param string|null $xGatewaySecret X-Gateway-Secret header
     * @return array
     */
    public function getMethods(?bool $includeDisabled = null, ?string $xGatewaySecret = null): array
    {
        $endpoint = "/v1/pay/methods";
        $headers = [];
        if ($xGatewaySecret !== null) {
            $headers['X-Gateway-Secret'] = $xGatewaySecret;
        }
        $params = [];
        if ($includeDisabled !== null) {
            $params['include_disabled'] = $includeDisabled;
        }
        return $this->get($endpoint, $params, $headers);
    }

    /**
     * تاریخچه تراکنشات.
     *
     * @param int|null $page page
     * @param int|null $perPage per_page
     * @param int|null $status status
     * @param string|null $fromDate from_date
     * @param string|null $toDate to_date
     * @param string|null $xGatewaySecret X-Gateway-Secret header
     * @return TransactionListResource
     */
    public function listTransactions(?int $page = null, ?int $perPage = null, ?int $status = null, ?string $fromDate = null, ?string $toDate = null, ?string $xGatewaySecret = null): TransactionListResource
    {
        $endpoint = "/v1/pay/transactions";
        $headers = [];
        if ($xGatewaySecret !== null) {
            $headers['X-Gateway-Secret'] = $xGatewaySecret;
        }
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }
        if ($status !== null) {
            $params['status'] = $status;
        }
        if ($fromDate !== null) {
            $params['from_date'] = $fromDate;
        }
        if ($toDate !== null) {
            $params['to_date'] = $toDate;
        }
        $response = $this->get($endpoint, $params, $headers);
        return TransactionListResource::fromArray($response);
    }

    /**
     * تراکنشات تایید نشده.
     *
     * @param int|null $page page
     * @param int|null $perPage per_page
     * @param string|null $xGatewaySecret X-Gateway-Secret header
     * @return TransactionListResource
     */
    public function listUnverified(?int $page = null, ?int $perPage = null, ?string $xGatewaySecret = null): TransactionListResource
    {
        $endpoint = "/v1/pay/transactions/unverified";
        $headers = [];
        if ($xGatewaySecret !== null) {
            $headers['X-Gateway-Secret'] = $xGatewaySecret;
        }
        $params = [];
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }
        $response = $this->get($endpoint, $params, $headers);
        return TransactionListResource::fromArray($response);
    }

    /**
     * استعلام وضعیت تراکنش.
     *
     * @param int|string $hashId hash_id
     * @param string|null $xGatewaySecret X-Gateway-Secret header
     * @return TransactionPublicResource
     */
    public function inquiryTransaction(string $hashId, ?string $xGatewaySecret = null): TransactionPublicResource
    {
        $endpoint = "/v1/pay/transactions/{$hashId}/inquiry";
        $headers = [];
        if ($xGatewaySecret !== null) {
            $headers['X-Gateway-Secret'] = $xGatewaySecret;
        }
        $response = $this->get($endpoint, [], $headers);
        return TransactionPublicResource::fromArray($response);
    }

    /**
     * تایید دستی تراکنش.
     *
     * @param int|string $hashId hash_id
     * @param string|null $xGatewaySecret X-Gateway-Secret header
     * @return TransactionPublicResource
     */
    public function verifyTransaction(string $hashId, ?string $xGatewaySecret = null): TransactionPublicResource
    {
        $endpoint = "/v1/pay/transactions/{$hashId}/verify";
        $headers = [];
        if ($xGatewaySecret !== null) {
            $headers['X-Gateway-Secret'] = $xGatewaySecret;
        }
        $response = $this->post($endpoint, [], [], $headers);
        return TransactionPublicResource::fromArray($response);
    }

    /**
     * ایجاد پیش‌تراکنش.
     *
     * @param CreatePreTransactionRequest $request Request payload
     * @param string|null $xGatewaySecret X-Gateway-Secret header
     * @return PreTransactionResource
     */
    public function createPreTransaction(CreatePreTransactionRequest $request, ?string $xGatewaySecret = null): PreTransactionResource
    {
        $endpoint = "/v1/pay/pre-transactions";
        $headers = [];
        if ($xGatewaySecret !== null) {
            $headers['X-Gateway-Secret'] = $xGatewaySecret;
        }
        $response = $this->post($endpoint, $request->toArray(), [], $headers);
        return PreTransactionResource::fromArray($response);
    }

    /**
     * لیست پلن‌های من.
     *
     * @return PlanListResource
     */
    public function listPlans(): PlanListResource
    {
        $endpoint = "/v1/plans";
        $response = $this->get($endpoint, [], []);
        return PlanListResource::fromArray($response);
    }

    /**
     * اشتراک‌های پلن‌های من.
     *
     * @param int|null $planId plan_id
     * @param int|null $status status
     * @param int|null $customerId customer_id
     * @param int|null $page page
     * @param int|null $perPage per_page
     * @return PlanSubscriptionListResource
     */
    public function listPlanSubscriptions(?int $planId = null, ?int $status = null, ?int $customerId = null, ?int $page = null, ?int $perPage = null): PlanSubscriptionListResource
    {
        $endpoint = "/v1/plans/subscriptions";
        $params = [];
        if ($planId !== null) {
            $params['plan_id'] = $planId;
        }
        if ($status !== null) {
            $params['status'] = $status;
        }
        if ($customerId !== null) {
            $params['customer_id'] = $customerId;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($perPage !== null) {
            $params['per_page'] = $perPage;
        }
        $response = $this->get($endpoint, $params, []);
        return PlanSubscriptionListResource::fromArray($response);
    }

    /**
     * جزئیات اشتراک فروخته‌شده.
     *
     * @param int|string $subscriptionId subscription_id
     * @return PlanSubscriptionResource
     */
    public function getPlanSubscription(int $subscriptionId): PlanSubscriptionResource
    {
        $endpoint = "/v1/plans/subscriptions/{$subscriptionId}";
        $response = $this->get($endpoint, [], []);
        return PlanSubscriptionResource::fromArray($response);
    }

}
