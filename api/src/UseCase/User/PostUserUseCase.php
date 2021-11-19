<?php

namespace App\UseCase\User;

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
        protected UserGateway $gateway
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

        $user = $this->transform($request);
        $this->gateway->create($user);

        $response->setData($user);
    }

    public function transform(UserRequest $request): User
    {
        return (new User())
            ->setName($request->getName());
    }
}
