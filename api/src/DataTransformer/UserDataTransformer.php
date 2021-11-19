<?php

namespace App\DataTransformer;

use App\Boundary\Input\User\UserRequest;
use App\Entity\User;

class UserDataTransformer implements DataTransformerInterface
{
    public function transform(UserRequest $request): User
    {
        return (new User())
            ->setName($request->getName());
    }
}
