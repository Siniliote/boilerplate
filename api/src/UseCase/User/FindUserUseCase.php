<?php

namespace App\UseCase\User;

use App\Boundary\Input\IdRequest;
use App\Boundary\Input\RequestInterface;
use App\Boundary\Output\ResponseInterface;
use App\Boundary\Output\User\UserResponse;
use App\Gateway\UserGateway;
use App\UseCase\UseCaseInterface;

class FindUserUseCase implements UseCaseInterface
{
    public function __construct(protected UserGateway $gateway)
    {
    }

    /**
     * @param IdRequest    $request
     * @param UserResponse $response
     */
    public function execute(RequestInterface $request, ResponseInterface $response): void
    {
        $user = $this->gateway->find($request->getId());
        if (!$user) {
            $response
                ->setStatus($response::NOT_FOUND)
                ->addError('User '.$request->getId().' not found');

            return;
        }

        $response->setData($user);
    }
}
