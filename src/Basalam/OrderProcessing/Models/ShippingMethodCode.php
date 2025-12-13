<?php

namespace Basalam\OrderProcessing\Models;

/**
 * Enum-like class that lists supported shipping method codes.
 */
class ShippingMethodCode
{
    public const SPECIAL = 3197;
    public const EXPRESS = 3198;
    public const COURIER = 3259;
    public const TRANSIT = 5137;
    public const TIPAX = 4040;
    public const MAHEX = 6102;
    public const CHAPAR = 6101;
    public const AMADAST = 6110;
    public const DECA = 6111;
    public const CHEETA = 6112;
    public const BOXIT = 6113;
    public const SALAM_RESAN = 6114;
}
