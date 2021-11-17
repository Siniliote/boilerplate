<?php

namespace App\UseCase;

use App\Boundary\Input\RequestInterface;
use App\Boundary\Output\ResponseInterface;
use App\Boundary\Output\StatusCodeInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AbstractPostUseCase
{
    public function __construct(protected ValidatorInterface $validator)
    {
    }

    protected function isValid(RequestInterface $request, ResponseInterface $response): bool
    {
        $errors = $this->validator->validate($request);
        if ($errors->count() > 0) {
            $response->setStatus(StatusCodeInterface::BAD_REQUEST);
            /** @var ConstraintViolationInterface $error */
            foreach ($errors as $error) {
                $response->addError((string) $error->getMessage());
            }
        }

        return 0 === $errors->count();
    }
}
