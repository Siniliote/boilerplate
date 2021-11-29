<?php

namespace App\Presenter;

use App\Boundary\Output\ResponseInterface;
use App\Boundary\Output\UserResponse;
use App\Entity\User;

class AuthPresenter implements PresenterInterface
{
    private ?User $user = null;

    /**
     * @param UserResponse $response
     */
    public function present(ResponseInterface $response): void
    {
        $this->user = $response->getUser();
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
}
