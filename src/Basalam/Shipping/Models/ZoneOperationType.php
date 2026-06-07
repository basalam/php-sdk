<?php

namespace Basalam\Shipping\Models;

/**
 * ZoneOperationType enum.
 */
class ZoneOperationType
{
    public const ADD = 'add';
    public const REMOVE = 'remove';
    public const SET = 'set';

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return [self::ADD, self::REMOVE, self::SET];
    }

    public static function isValid(string $value): bool
    {
        return in_array($value, self::values(), true);
    }
}
