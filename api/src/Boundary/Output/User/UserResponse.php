<?php

namespace App\Boundary\Output\User;

use App\Boundary\Output\AbstractResponse;
use App\Dto\UserDto;
use App\Entity\User;

class UserResponse extends AbstractResponse
{
    private ?User $data = null;

    public function getData(): ?User
    {
        return $this->data;
    }

    public function setData(?User $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function toDto(): UserDto
    {
        return (new UserDto())
            ->setId($this->getData()?->getId())
            ->setName($this->getData()?->getName());
    }
}
