<?php

namespace App\UseCase;

use App\Boundary\Input\RequestInterface;
use App\Boundary\Output\ResponseInterface;

interface UseCaseInterface
{
    public function execute(RequestInterface $request, ResponseInterface $response): void;
}
