<?php

namespace App\UseCase\User;

use App\Boundary\Input\RequestInterface;
use App\Gateway\UserGateway;
use App\Presenter\PresenterInterface;
use App\UseCase\UseCaseInterface;

class FindAllUserUseCase implements UseCaseInterface
{
    public function __construct(protected UserGateway $gateway)
    {
    }

    public function execute(RequestInterface $request, PresenterInterface $presenter): void
    {
        $users = $this->gateway->findAll();
    }
}
