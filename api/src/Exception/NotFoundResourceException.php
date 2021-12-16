<?php

namespace App\Exception;

use App\Boundary\Output\StatusCodeInterface;

class NotFoundResourceException extends DomainException
{
    public function __construct(string $message = 'Resource not found', int $code = StatusCodeInterface::NOT_FOUND, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
