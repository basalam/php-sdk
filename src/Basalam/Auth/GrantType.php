<?php

namespace Basalam\Auth;

/**
 * Available OAuth grant types for Basalam API.
 */
class GrantType
{
    const CLIENT_CREDENTIALS = 'client_credentials';
    const AUTHORIZATION_CODE = 'authorization_code';
    const REFRESH_TOKEN = 'refresh_token';
}