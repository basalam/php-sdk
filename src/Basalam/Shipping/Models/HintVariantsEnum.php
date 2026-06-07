<?php

namespace Basalam\Shipping\Models;

/**
 * HintVariantsEnum enum.
 */
class HintVariantsEnum
{
    public const INFO = 'info';
    public const WARNING = 'warning';
    public const DANGER = 'danger';
    public const NORMAL = 'normal';
    public const SUCCESS = 'success';

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return [self::INFO, self::WARNING, self::DANGER, self::NORMAL, self::SUCCESS];
    }

    public static function isValid(string $value): bool
    {
        return in_array($value, self::values(), true);
    }
}
