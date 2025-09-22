<?php

namespace Basalam\Exceptions;

use Psr\Http\Message\ResponseInterface;

/**
 * Exception raised for authentication errors.
 */
class AuthException extends ApiException
{
    /**
     * Initialize the authentication error.
     *
     * @param string $message
     * @param ResponseInterface|null $response
     * @param mixed $responseData
     * @param \Throwable|null $previous
     */
    public function __construct(
        string             $message,
        ?ResponseInterface $response = null,
                           $responseData = null,
        ?\Throwable        $previous = null
    )
    {
        // Authentication errors always have status code 401
        parent::__construct(
            message: $message,
            statusCode: 401,
            code: null,
            response: $response,
            responseData: $responseData,
            previous: $previous
        );
    }
}