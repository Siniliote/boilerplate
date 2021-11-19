<?php

namespace App\Adapter\Response;

use App\Boundary\Output\User\Model\UserModel;
use App\Entity\User;

class UserModelAdapter
{
    public function adapte(User $user): UserModel
    {
        return (new UserModel())
            ->setId($user->getId())
            ->setName($user->getName());
    }
}
