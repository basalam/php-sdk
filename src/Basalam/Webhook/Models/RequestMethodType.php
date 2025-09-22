<?php

namespace Basalam\Webhook\Models;

/**
 * Request method type enum.
 */
class RequestMethodType
{
    const POST = 'POST';
    const PUT = 'PUT';
    const PATCH = 'PATCH';

    /**
     * Check if a method is valid.
     *
     * @param string $method
     * @return bool
     */
    public static function isValid(string $method): bool
    {
        return in_array($method, self::getAllMethods(), true);
    }

    /**
     * Get all valid request methods.
     *
     * @return array
     */
    public static function getAllMethods(): array
    {
        return [
            self::POST,
            self::PUT,
            self::PATCH,
        ];
    }
}