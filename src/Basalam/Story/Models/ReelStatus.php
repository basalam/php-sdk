<?php

namespace Basalam\Story\Models;

/**
 * ReelStatus enum.
 */
class ReelStatus
{
    public const CONFIRMED = 'confirmed';
    public const DELETED = 'deleted';
    public const FILTERED = 'filtered';
    public const CHECKING = 'checking';
    public const ALL = 'all';

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return [self::CONFIRMED, self::DELETED, self::FILTERED, self::CHECKING, self::ALL];
    }

    public static function isValid(string $value): bool
    {
        return in_array($value, self::values(), true);
    }
}
