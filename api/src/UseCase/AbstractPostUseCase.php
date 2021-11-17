<?php

namespace App\UseCase;

use App\Boundary\Input\RequestInterface;
use App\Boundary\Output\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;
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
            $response->setStatus(Response::HTTP_BAD_REQUEST);
            foreach ($errors as $error) {
                $response->addError($error->getMessage());
            }
        }

        return 0 === $errors->count();
    }
}
