<?php

namespace Basalam\Order;

use Basalam\Auth\BaseAuth;
use Basalam\Config\Config;
use Basalam\Http\BaseClient;
use Basalam\Order\Models\BasketResponse;
use Basalam\Order\Models\CreatePaymentRequestModel;
use Basalam\Order\Models\OrderEnum;
use Basalam\Order\Models\PaymentCallbackRequestModel;
use Basalam\Order\Models\PaymentVerifyRequestModel;

/**
 * Client for the Basalam Order Service API.
 *
 * This client provides methods for managing payments and invoices.
 */
class OrderService extends BaseClient
{
    public function __construct(BaseAuth $auth, ?Config $config = null)
    {
        parent::__construct($auth, $config, 'order');
    }

    /**
     * Get active baskets.
     *
     * @param bool $refresh Whether to refresh the basket data from the server
     * @return BasketResponse The active basket data
     */
    public function getBaskets(bool $refresh = false): BasketResponse
    {
        $endpoint = '/v2/basket';  // Fixed: Changed from /v2/baskets to /v2/basket
        $params = ['refresh' => $refresh];

        $response = $this->get($endpoint, $params);
        return BasketResponse::fromArray($response);
    }

    /**
     * Get product variation status.
     *
     * @param int $productId
     * @return array
     */
    public function getProductVariationStatus(int $productId): array
    {
        $endpoint = "/v2/basket/product/$productId/status";  // Fixed endpoint
        return $this->get($endpoint);
    }

    /**
     * Create payment for an invoice.
     *
     * @param int $invoiceId
     * @param CreatePaymentRequestModel $request
     * @return array
     */
    public function createInvoicePayment(int $invoiceId, CreatePaymentRequestModel $request): array
    {
        $endpoint = "/v2/invoice/$invoiceId/payment";  // Fixed: Changed from plural to singular
        return $this->post($endpoint, $request->toArray());
    }

    /**
     * Get payable invoices.
     *
     * @param int $page
     * @param int $perPage
     * @return array
     */
    public function getPayableInvoices(int $page, int $perPage): array
    {
        $endpoint = '/v2/invoice/payable';  // Fixed: Changed from plural to singular
        $params = [
            'page' => $page,
            'per_page' => $perPage
        ];
        return $this->get($endpoint, $params);
    }

    /**
     * Get unpaid invoices.
     *
     * @param int|null $invoiceId
     * @param string|null $status Use UnpaidInvoiceStatusEnum constants
     * @param int $page
     * @param int $perPage
     * @param string $sort Use OrderEnum constants (ASC or DESC)
     * @return array
     */
    public function getUnpaidInvoices(
        ?int    $invoiceId = null,
        ?string $status = null,
        int     $page = 1,
        int     $perPage = 20,
        string  $sort = OrderEnum::DESC
    ): array
    {
        $endpoint = '/v2/invoice/unpaid';  // Fixed: Changed from plural to singular
        $params = [
            'page' => $page,
            'per_page' => $perPage,
            'sort' => $sort
        ];

        if ($invoiceId !== null) {
            $params['invoice_id'] = $invoiceId;
        }
        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->get($endpoint, $params);
    }

    /**
     * Get payment callback.
     *
     * @param int $paymentId
     * @param PaymentCallbackRequestModel $request
     * @return array
     */
    public function getPaymentCallback(int $paymentId, PaymentCallbackRequestModel $request): array
    {
        $endpoint = "/v2/payment/$paymentId/callback";  // Fixed: Changed from plural to singular
        return $this->get($endpoint, $request->toArray());
    }

    /**
     * Create payment callback.
     *
     * @param int $paymentId
     * @param PaymentVerifyRequestModel $request
     * @return array
     */
    public function createPaymentCallback(int $paymentId, PaymentVerifyRequestModel $request): array
    {
        $endpoint = "/v2/payment/$paymentId/callback";  // Fixed: Changed from plural to singular
        return $this->post($endpoint, $request->toArray());
    }
}