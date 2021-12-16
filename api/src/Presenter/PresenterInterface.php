<?php

namespace App\Presenter;

use App\Boundary\Output\ResponseInterface;

interface PresenterInterface
{
    public function present(ResponseInterface $response): void;
}
