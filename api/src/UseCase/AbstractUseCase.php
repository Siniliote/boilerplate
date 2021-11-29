<?php

namespace App\UseCase;

use App\Boundary\Input\EmptyRequest;
use App\Boundary\Input\RequestInterface;
use App\Exception\InvalidRequestException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractUseCase
{
    public function __construct(protected ValidatorInterface $validator)
    {
    }

    /**
     * @throws InvalidRequestException
     */
    protected function isValid(RequestInterface $request): bool
    {
        if ($request instanceof EmptyRequest) {
            return true;
        }

        $errors = $this->validator->validate($request);

        if ($errors->count() > 0) {
            throw new InvalidRequestException();
        }

        return true;
    }
}
