<?php

namespace Basalam\Exceptions;

/**
 * Exception raised for data validation errors.
 */
class ValidationException extends BasalamException
{
    private array $errors;

    public function __construct(
        string      $message,
        array       $errors = [],
        ?\Throwable $previous = null
    )
    {
        parent::__construct($message, 0, $previous);
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}