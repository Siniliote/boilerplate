<?php

namespace App\UseCase\User;

use App\Adapter\Response\UserModelAdapter;
use App\Boundary\Input\EmptyRequest;
use App\Boundary\Input\RequestInterface;
use App\Boundary\Output\ResponseInterface;
use App\Boundary\Output\User\UserListResponse;
use App\Entity\User;
use App\Gateway\UserGateway;
use App\UseCase\UseCaseInterface;

class FindAllUserUseCase implements UseCaseInterface
{
    public function __construct(protected UserGateway $gateway, protected UserModelAdapter $adapter)
    {
    }

    /**
     * @param EmptyRequest     $request
     * @param UserListResponse $response
     */
    public function execute(RequestInterface $request, ResponseInterface $response): void
    {
        $users = $this->gateway->findAll();
        /** @var User $user */
        foreach ($users as $user) {
            $response->addData($this->adapter->adapte($user));
        }
    }
}
