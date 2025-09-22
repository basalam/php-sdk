<?php

namespace Basalam\Chat\Models;

/**
 * Order by enumeration for get_chats endpoint
 */
class MessageOrderByEnum
{
    const UPDATED_AT = 'updated_at';
    const MODIFIED_AT = 'modified_at';
    const CREATED_AT = 'created_at';
}