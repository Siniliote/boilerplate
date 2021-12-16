<?php

namespace App\Boundary\Output;

use App\Entity\User;

class UserResponse implements ResponseInterface
{
    public function __construct(
        private User $user,
    ) {
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
