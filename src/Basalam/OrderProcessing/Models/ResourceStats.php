<?php

namespace Basalam\OrderProcessing\Models;

/**
 * Enum for resource statistics types.
 */
class ResourceStats
{
    const NUMBER_OF_COUPON_USED_IN_ORDERS = 'number-of-coupon-used-in-orders';
    const NUMBER_OF_PURCHASES_PER_CUSTOMER = 'number-of-purchases-per-customer';
    const NUMBER_OF_ORDERS_PER_CUSTOMER = 'number-of-orders-per-customer';
    const TOTAL_OF_PURCHASE_AMOUNT_PER_CUSTOMER = 'total-of-purchase-amount-per-customer';
    const NUMBER_OF_SALES_PER_VENDOR = 'number-of-sales-per-vendor';
    const NUMBER_OF_ORDERS_PER_VENDOR = 'number-of-orders-per-vendor';
    const NUMBER_OF_NEW_ORDERS_PER_VENDOR = 'number-of-new-orders-per-vendor';
    const NUMBER_OF_PROBLEM_ORDERS_PER_VENDOR = 'number-of-problem-orders-per-vendor';
    const NUMBER_OF_DUE_ORDERS_PER_VENDOR = 'number-of-due-orders-per-vendor';
    const TOTAL_OF_SALES_AMOUNT_PER_VENDOR = 'total-of-sales-amount-per-vendor';
    const NUMBER_OF_SALES_PER_PRODUCT = 'number-of-sales-per-product';
    const NUMBER_OF_NOT_SHIPPED_ORDERS_PER_VENDOR = 'number-of-not-shipped-orders-per-vendor';
    const NUMBER_OF_SHIPPED_ORDERS_PER_VENDOR = 'number-of-shipped-orders-per-vendor';
    const NUMBER_OF_PENDING_ORDERS_PER_VENDOR = 'number-of-pending-orders-per-vendor';
    const NUMBER_OF_COMPLETED_ORDERS_PER_VENDOR = 'number-of-completed-orders-per-vendor';
}

