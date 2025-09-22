<?php

namespace Basalam\Exceptions;

use Exception;

/**
 * Base exception for all Basalam SDK errors.
 */
class BasalamException extends Exception
{
    protected string $basalamMessage;

    /**
     * Initialize the exception with a message.
     *
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(string $message, int $code = 0, ?\Throwable $previous = null)
    {
        $this->basalamMessage = $message;
        parent::__construct($message, $code, $previous);
    }

    /**
     * Get the Basalam-specific message.
     *
     * @return string
     */
    public function getBasalamMessage(): string
    {
        return $this->basalamMessage;
    }
}