<?php

namespace App\UseCase\User;

use App\Boundary\Input\User\UserRequest;
use App\Boundary\Output\User\UserResponse;
use App\Entity\User;
use App\Gateway\UserGateway;
use App\Hydrator\Response\UserHydrator;
use App\UseCase\AbstractPostUseCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostUserUseCase extends AbstractPostUseCase
{
    public function __construct(
        ValidatorInterface $validator,
        protected UserGateway $gateway,
        protected UserHydrator $hydrator
    ) {
        parent::__construct($validator);
    }

    public function execute(UserRequest $request, UserResponse $response): void
    {
        if (!$this->isValid($request, $response)) {
            return;
        }

        $user = $this->buildEntity($request);
        $this->gateway->create($user);
        $this->hydrator->hydrate($response, $user);
    }

    private function buildEntity(UserRequest $request): User
    {
        return (new User())->setName($request->getName());
    }
}
