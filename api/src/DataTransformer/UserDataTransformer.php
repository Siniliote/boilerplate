<?php

namespace App\DataTransformer;

use App\Boundary\Input\User\UserRequest;
use App\Dto\UserDto;
use App\Entity\User;

class UserDataTransformer implements DataTransformerInterface
{
    public function transform(UserRequest $request): User
    {
        return (new User())
            ->setName($request->getName());
    }

    public function reverseTransform(User $user): UserDto
    {
        return (new UserDto())
            ->setId($user->getId())
            ->setName($user->getName());
    }
}
