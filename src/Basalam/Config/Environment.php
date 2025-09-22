<?php

namespace Basalam\Config;

/**
 * Available environments for the Basalam API.
 */
class Environment
{
    const PRODUCTION = 'production';
    const DEVELOPMENT = 'development';

    /**
     * Normalize environment string (ensure it's valid)
     *
     * @param string $environment
     * @return string
     * @throws \InvalidArgumentException
     */
    public static function normalize(string $environment): string
    {
        $environment = strtolower($environment);

        if (!self::isValid($environment)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Invalid environment "%s". Must be one of: %s',
                    $environment,
                    implode(', ', self::getAll())
                )
            );
        }

        return $environment;
    }

    /**
     * Validate if the given environment is valid
     *
     * @param string $environment
     * @return bool
     */
    public static function isValid(string $environment): bool
    {
        return in_array($environment, [
            self::PRODUCTION,
            self::DEVELOPMENT,
        ], true);
    }

    /**
     * Get all available environments
     *
     * @return array
     */
    public static function getAll(): array
    {
        return [
            self::PRODUCTION,
            self::DEVELOPMENT,
        ];
    }
}