<?php

namespace App\Exception;

use App\Boundary\Output\StatusCodeInterface;

class InvalidRequestException extends DomainException
{
    public function __construct(string $message = 'Request invalid', int $code = StatusCodeInterface::BAD_REQUEST, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
