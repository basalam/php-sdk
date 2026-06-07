<?php

namespace Basalam\Story\Models;

/**
 * ReelType enum.
 */
class ReelType
{
    public const REVIEW = 'review';
    public const TUTORIAL = 'tutorial';
    public const BUSINESS = 'business';
    public const OTHER = 'other';

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return [self::REVIEW, self::TUTORIAL, self::BUSINESS, self::OTHER];
    }

    public static function isValid(string $value): bool
    {
        return in_array($value, self::values(), true);
    }
}
