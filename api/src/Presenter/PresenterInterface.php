<?php

namespace App\Presenter;

use App\Boundary\Output\ResponseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

interface PresenterInterface
{
    public function present(ResponseInterface $response): JsonResponse;
}
