<?php

namespace App\Presenter;

use App\Boundary\Output\ResponseInterface;
use App\Boundary\Output\UserResponse;
use App\Entity\User;
use App\ViewModel\UserViewModel;

class UserPresenter implements PresenterInterface
{
    private ?User $user = null;

    private ?User $authentication = null;

    /**
     * @param UserResponse $response
     */
    public function present(ResponseInterface $response): void
    {
        $this->user = $response->getUser();
    }

    public function getViewModel(): UserViewModel
    {
        return new UserViewModel(
            $this->getUser()->getName()
        );
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAuthentication(): ?User
    {
        return $this->authentication;
    }

    public function setAuthentication(User $authentication): self
    {
        $this->authentication = $authentication;

        return $this;
    }
}
