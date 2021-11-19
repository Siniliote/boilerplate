<?php

namespace App\UseCase\User;

use App\Boundary\Input\EmptyRequest;
use App\Boundary\Input\RequestInterface;
use App\Boundary\Output\ResponseInterface;
use App\Boundary\Output\User\UserListResponse;
use App\DataTransformer\UserDataTransformer;
use App\Entity\User;
use App\Gateway\UserGateway;
use App\UseCase\UseCaseInterface;

class FindAllUserUseCase implements UseCaseInterface
{
    public function __construct(protected UserGateway $gateway, protected UserDataTransformer $dataTransformer)
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
            $response->addData($this->dataTransformer->reverseTransform($user));
        }
    }
}
