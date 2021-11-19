<?php

namespace App\UseCase\User;

use App\Boundary\Input\RequestInterface;
use App\Boundary\Input\User\UserRequest;
use App\Boundary\Output\ResponseInterface;
use App\Boundary\Output\User\UserResponse;
use App\DataTransformer\UserDataTransformer;
use App\Gateway\UserGateway;
use App\UseCase\AbstractPostUseCase;
use App\UseCase\UseCaseInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostUserUseCase extends AbstractPostUseCase implements UseCaseInterface
{
    public function __construct(
        ValidatorInterface $validator,
        protected UserGateway $gateway,
        protected UserDataTransformer $dataTransformer
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

        $user = $this->dataTransformer->transform($request);
        $this->gateway->create($user);

        $response->setData($this->dataTransformer->reverseTransform($user));
    }
}
