<?php

namespace App\UseCase\User;

use App\Boundary\Input\IdRequest;
use App\Boundary\Output\User\UserResponse;
use App\Gateway\UserGateway;
use App\Hydrator\Response\UserHydrator;

class FindUserUseCase
{
    public function __construct(protected UserGateway $gateway, protected UserHydrator $hydrator)
    {
    }

    public function execute(IdRequest $request, UserResponse $response): void
    {
        $user = $this->gateway->find($request->getId());
        if (!$user) {
            $response
                ->setStatus($response::NOT_FOUND)
                ->addError('User '.$request->getId().' not found');

            return;
        }

        $this->hydrator->hydrate($response, $user);
    }
}
