<?php

namespace App\Exception;

use App\Boundary\Output\StatusCodeInterface;

class InvalidResponseException extends DomainException
{
    public function __construct(string $message = 'Response invalid', int $code = StatusCodeInterface::BAD_REQUEST, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
