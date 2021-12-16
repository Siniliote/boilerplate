<?php

namespace App\UseCase;

use App\Boundary\Input\RequestInterface;
use App\Presenter\PresenterInterface;

interface UseCaseInterface
{
    public function execute(RequestInterface $request, PresenterInterface $presenter): void;
}
