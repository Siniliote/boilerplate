<?php

namespace App\UseCase\User;

use App\Boundary\Input\IdRequest;
use App\Boundary\Input\RequestInterface;
use App\Boundary\Output\UserResponse;
use App\Exception\InvalidRequestException;
use App\Exception\NotFoundResourceException;
use App\Gateway\UserGateway;
use App\Presenter\PresenterInterface;
use App\UseCase\AbstractUseCase;
use App\UseCase\UseCaseInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FindUserUseCase extends AbstractUseCase implements UseCaseInterface
{
    public function __construct(
        protected ValidatorInterface $validator,
        private UserGateway $gateway,
    ) {
        parent::__construct($validator);
    }

    /**
     * @param IdRequest $request
     *
     * @throws InvalidRequestException
     * @throws NotFoundResourceException
     */
    public function execute(RequestInterface $request, PresenterInterface $presenter): void
    {
        $this->isValid($request);

        $user = $this->gateway->find($request->getId());

        if (!$user) {
            throw new NotFoundResourceException('User not found');
        }

        $presenter->present(new UserResponse($user));
    }
}
