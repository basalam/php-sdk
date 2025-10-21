<?php

namespace Basalam\OrderProcessing;

use Basalam\Auth\BaseAuth;
use Basalam\Config\Config;
use Basalam\Http\BaseClient;
use Basalam\OrderProcessing\Models\CustomerItemResponse;
use Basalam\OrderProcessing\Models\CustomerItemsResponse;
use Basalam\OrderProcessing\Models\ItemFilter;
use Basalam\OrderProcessing\Models\Order;
use Basalam\OrderProcessing\Models\OrderFilter;
use Basalam\OrderProcessing\Models\OrderParcelFilter;
use Basalam\OrderProcessing\Models\OrdersResponse;
use Basalam\OrderProcessing\Models\OrderStatsResponse;
use Basalam\OrderProcessing\Models\ParcelResponse;
use Basalam\OrderProcessing\Models\ParcelsResponse;

/**
 * Client for the Basalam Order Processing Service API.
 *
 * This client provides methods for interacting with customer orders,
 * vendor orders, and order statistics.
 */
class OrderProcessingService extends BaseClient
{
    public function __construct(BaseAuth $auth, ?Config $config = null)
    {
        parent::__construct($auth, $config, 'order-processing');
    }

    /**
     * Get a list of customer orders.
     *
     * @param OrderFilter|null $filters Optional filters to apply to the query
     * @return OrdersResponse The response containing the list of orders
     */
    public function getCustomerOrders(?OrderFilter $filters = null): OrdersResponse
    {
        $endpoint = '/v1/customer-orders';
        $filters = $filters ?? new OrderFilter();
        $params = $filters->toArray();

        // Handle field mapping for API compatibility
        if (isset($params['items_title'])) {
            $params['items.title'] = $params['items_title'];
            unset($params['items_title']);
        }
        if (isset($params['parcel_estimate_send_at'])) {
            $params['parcel.estimate_send_at'] = $params['parcel_estimate_send_at'];
            unset($params['parcel_estimate_send_at']);
        }
        if (isset($params['parcel_statuses'])) {
            $params['parcel.statuses'] = $params['parcel_statuses'];
            unset($params['parcel_statuses']);
        }

        $response = $this->get($endpoint, $params);
        return OrdersResponse::fromArray($response);
    }

    /**
     * Get details of a specific order.
     *
     * @param int $orderId The ID of the order to retrieve
     * @return Order The response containing the order details
     */
    public function getCustomerOrder(int $orderId): Order
    {
        $endpoint = "/v1/customer-orders/$orderId";
        $response = $this->get($endpoint);
        return Order::fromArray($response);
    }

    /**
     * Get a list of order items.
     *
     * @param ItemFilter|null $filters Optional filters to apply to the query
     * @return CustomerItemsResponse The response containing the list of items
     */
    public function getCustomerOrderItems(?ItemFilter $filters = null): CustomerItemsResponse
    {
        $endpoint = '/v1/customer-orders/items';
        $filters = $filters ?? new ItemFilter();
        $params = $filters->toArray();

        $response = $this->get($endpoint, $params);
        return CustomerItemsResponse::fromArray($response);
    }

    /**
     * Get details of a specific order item.
     *
     * @param int $itemId The ID of the item to retrieve
     * @return CustomerItemResponse The response containing the item details
     */
    public function getCustomerOrderItem(int $itemId): CustomerItemResponse
    {
        $endpoint = "/v1/customer-orders/items/$itemId";
        $response = $this->get($endpoint);
        return CustomerItemResponse::fromArray($response);
    }

    /**
     * Get a list of orders parcels.
     *
     * @param OrderParcelFilter|null $filters Optional filters to apply to the query
     * @return ParcelsResponse The response containing the list of parcels
     */
    public function getVendorOrdersParcels(?OrderParcelFilter $filters = null): ParcelsResponse
    {
        $endpoint = '/v1/vendor-parcels';
        $filters = $filters ?? new OrderParcelFilter();

        $params = [];
        if ($filters->getCreatedAt() !== null) {
            $params['created_at'] = $filters->getCreatedAt();
        }
        if ($filters->getCursor() !== null) {
            $params['cursor'] = $filters->getCursor();
        }
        if ($filters->getEstimateSendAt() !== null) {
            $params['estimate_send_at'] = $filters->getEstimateSendAt();
        }
        if ($filters->getIds() !== null) {
            $params['ids'] = $filters->getIds();
        }
        if ($filters->getItemsCustomerIds() !== null) {
            $params['items.customer_ids'] = $filters->getItemsCustomerIds();
        }
        if ($filters->getItemsOrderIds() !== null) {
            $params['items.order_ids'] = $filters->getItemsOrderIds();
        }
        if ($filters->getItemsProductIds() !== null) {
            $params['items.product_ids'] = $filters->getItemsProductIds();
        }
        if ($filters->getItemsVendorIds() !== null) {
            $params['items.vendor_ids'] = $filters->getItemsVendorIds();
        }
        if ($filters->getPerPage() !== null) {
            $params['per_page'] = $filters->getPerPage();
        }
        if ($filters->getSort() !== null) {
            $params['sort'] = $filters->getSort();
        }
        if ($filters->getStatuses() !== null) {
            // Convert status array to comma-separated string
            $params['statuses'] = implode(',', $filters->getStatuses());
        }

        $response = $this->get($endpoint, $params);
        return ParcelsResponse::fromArray($response);
    }

    /**
     * Get details of a specific order parcel.
     *
     * @param int $parcelId The ID of the parcel to retrieve
     * @return ParcelResponse The response containing the parcel details
     */
    public function getOrderParcel(int $parcelId): ParcelResponse
    {
        $endpoint = "/v1/vendor-parcels/$parcelId";
        $response = $this->get($endpoint);
        return ParcelResponse::fromArray($response);
    }

    /**
     * Get order statistics.
     *
     * @param string $resourceCount The type of statistics to retrieve (use ResourceStats constants)
     * @param int|null $vendorId Optional vendor ID to filter by
     * @param int|null $productId Optional product ID to filter by
     * @param int|null $customerId Optional customer ID to filter by
     * @param string|null $couponCode Optional coupon code to filter by
     * @param string|null $cacheControl Optional cache control header
     * @return OrderStatsResponse The response containing the order statistics
     */
    public function getOrdersStats(
        string  $resourceCount,
        ?int    $vendorId = null,
        ?int    $productId = null,
        ?int    $customerId = null,
        ?string $couponCode = null,
        ?string $cacheControl = null
    ): OrderStatsResponse
    {
        $endpoint = '/v1/orders/stats';

        $params = ['resource_count' => $resourceCount];
        if ($vendorId !== null) {
            $params['vendor_id'] = $vendorId;
        }
        if ($productId !== null) {
            $params['product_id'] = $productId;
        }
        if ($customerId !== null) {
            $params['customer_id'] = $customerId;
        }
        if ($couponCode !== null) {
            $params['coupon_code'] = $couponCode;
        }

        $headers = [];
        if ($cacheControl !== null) {
            $headers['Cache-Control'] = $cacheControl;
        }

        $response = $this->get($endpoint, $params, $headers);
        return OrderStatsResponse::fromArray($response);
    }
}