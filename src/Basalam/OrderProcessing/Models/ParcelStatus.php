<?php

namespace Basalam\OrderProcessing\Models;

/**
 * Enum for parcel status.
 */
class ParcelStatus
{
    const NEW_ORDER = 3739;
    const PREPARATION_IN_PROGRESS = 3237;
    const POSTED = 3238;
    const WRONG_TRACKING_CODE = 5017;
    const PRODUCT_IS_NOT_DELIVERED = 3572;
    const PROBLEM_IS_REPORTED = 3740;
    const CUSTOMER_CANCEL_REQUEST_FROM_CUSTOMER = 4633;
    const OVERDUE_AGREEMENT_REQUEST_FROM_VENDOR = 5075;
    const SATISFIED = 3195;
    const DEFINITIVE_DISSATISFACTION = 3233;
    const CANCEL = 3067;
}