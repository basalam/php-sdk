<?php

namespace Basalam;

/**
 * Version information for the Basalam SDK.
 *
 * This class centralizes version management and User-Agent generation.
 */
class Version
{
    /**
     * SDK version
     */
    const VERSION = '1.1.3';

    /**
     * SDK name
     */
    const SDK_NAME = 'basalam-php-sdk';

    /**
     * Get the current SDK version
     *
     * @return string
     */
    public static function getVersion(): string
    {
        return self::VERSION;
    }

    /**
     * Get the SDK name
     *
     * @return string
     */
    public static function getSdkName(): string
    {
        return self::SDK_NAME;
    }

    /**
     * Get the User-Agent string for the SDK.
     *
     * @param string|null $customAgent Optional custom User-Agent to append to SDK User-Agent
     * @return string Complete User-Agent string
     */
    public static function getUserAgent(?string $customAgent = null): string
    {
        $sdkAgent = self::SDK_NAME . '/' . self::VERSION;

        if ($customAgent) {
            return trim($sdkAgent . ' ' . $customAgent);
        }

        return $sdkAgent;
    }

    /**
     * Get full version information including PHP version
     *
     * @return string
     */
    public static function getFullVersion(): string
    {
        return sprintf(
            '%s/%s (PHP/%s)',
            self::SDK_NAME,
            self::VERSION,
            PHP_VERSION
        );
    }
}