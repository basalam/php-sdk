<?php

namespace Basalam\Upload\Models;

/**
 * User upload file type enum
 *
 * This class simulates an enum for PHP 8.0 compatibility.
 * Use the constants directly like: UserUploadFileTypeEnum::PRODUCT_PHOTO
 *
 * IMPORTANT: These use dot notation (e.g., "product.photo") not underscores
 */
final class UserUploadFileTypeEnum
{
    public const PRODUCT_PHOTO = 'product.photo';
    public const PRODUCT_VIDEO = 'product.video';
    public const USER_AVATAR = 'user.avatar';
    public const USER_COVER = 'user.cover';
    public const VENDOR_COVER = 'vendor.cover';
    public const VENDOR_LOGO = 'vendor.logo';
    public const CHAT_PHOTO = 'chat.photo';
    public const CHAT_VIDEO = 'chat.video';
    public const CHAT_VOICE = 'chat.voice';
    public const CHAT_FILE = 'chat.file';

    /**
     * Private constructor to prevent instantiation
     */
    private function __construct()
    {
    }

    /**
     * Get file types for a specific category
     *
     * @param string $category One of: product, user, vendor, chat
     * @return array<string>
     */
    public static function getByCategory(string $category): array
    {
        switch (strtolower($category)) {
            case 'product':
                return [self::PRODUCT_PHOTO, self::PRODUCT_VIDEO];
            case 'user':
                return [self::USER_AVATAR, self::USER_COVER];
            case 'vendor':
                return [self::VENDOR_COVER, self::VENDOR_LOGO];
            case 'chat':
                return [self::CHAT_PHOTO, self::CHAT_VIDEO, self::CHAT_VOICE, self::CHAT_FILE];
            default:
                return [];
        }
    }

    /**
     * Validate that a value is a valid enum constant
     * This method is used for strict type checking
     *
     * @param string $value
     * @return string The validated value
     * @throws \InvalidArgumentException If the value is not a valid enum constant
     */
    public static function validate(string $value): string
    {
        if (!self::isValid($value)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid file type: '%s'. Must be one of: %s",
                    $value,
                    implode(', ', self::getAllTypes())
                )
            );
        }
        return $value;
    }

    /**
     * Check if a file type is valid
     *
     * @param string $fileType
     * @return bool
     */
    public static function isValid(string $fileType): bool
    {
        return in_array($fileType, self::getAllTypes(), true);
    }

    /**
     * Get all valid file types
     *
     * @return array<string>
     */
    public static function getAllTypes(): array
    {
        return [
            self::PRODUCT_PHOTO,
            self::PRODUCT_VIDEO,
            self::USER_AVATAR,
            self::USER_COVER,
            self::VENDOR_COVER,
            self::VENDOR_LOGO,
            self::CHAT_PHOTO,
            self::CHAT_VIDEO,
            self::CHAT_VOICE,
            self::CHAT_FILE,
        ];
    }
}