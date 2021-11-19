<?php

namespace App\UseCase\User;

use App\Adapter\Response\UserModelAdapter;
use App\Boundary\Input\RequestInterface;
use App\Boundary\Input\User\UserRequest;
use App\Boundary\Output\ResponseInterface;
use App\Boundary\Output\User\UserResponse;
use App\Entity\User;
use App\Gateway\UserGateway;
use App\UseCase\AbstractPostUseCase;
use App\UseCase\UseCaseInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostUserUseCase extends AbstractPostUseCase implements UseCaseInterface
{
    public function __construct(
        ValidatorInterface $validator,
        protected UserGateway $gateway,
        protected UserModelAdapter $adapter
    ) {
        parent::__construct($validator);
    }

    /**
     * @param UserRequest  $request
     * @param UserResponse $response
     */
    public function execute(RequestInterface $request, ResponseInterface $response): void
    {
        if (!$this->isValid($request, $response)) {
            return;
        }

        $user = $this->buildEntity($request);
        $this->gateway->create($user);

        $response->setData($this->adapter->adapte($user));
    }

    private function buildEntity(UserRequest $request): User
    {
        return (new User())->setName($request->getName());
    }
}
