<?php

namespace App\Tests\Unit\Utils;

use App\Entity\User;
use App\Tests\Mock\Repository\InMemory\UserRepository;

trait CreateUserTrait
{
    protected function createUserEntity(UserRepository $userRepository, string $name): void
    {
        $user = (new User())->setName($name);
        $userRepository->create($user);
    }
}
