<?php

namespace Basalam\Shipping\Models;

/**
 * FreeShippingRuleType enum.
 */
class FreeShippingRuleType
{
    public const CONDITIONAL = 'conditional';
    public const NEVER_FREE = 'never_free';

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return [self::CONDITIONAL, self::NEVER_FREE];
    }

    public static function isValid(string $value): bool
    {
        return in_array($value, self::values(), true);
    }
}
