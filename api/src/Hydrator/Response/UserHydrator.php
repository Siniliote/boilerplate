<?php

namespace App\Hydrator\Response;

use App\Boundary\Output\User\UserResponse;
use App\Entity\User;

class UserHydrator
{
    public function hydrate(UserResponse $response, User $user): void
    {
        $response
            ->setId($user->getId())
            ->setName($user->getName());
    }
}
