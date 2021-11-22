<?php

namespace App\Boundary\Output\User;

use App\Boundary\Output\AbstractResponse;
use App\Dto\UserDto;
use App\Entity\User;

class UserListResponse extends AbstractResponse
{
    /**
     * @var User[]
     */
    private array $data = [];

    /**
     * @return User[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param User[] $data
     */
    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function addData(User $user): self
    {
        $this->data[] = $user;

        return $this;
    }

    public function toDto(): array
    {
        foreach ($this->getData() as $user) {
            $result[] = (new UserDto())
                ->setId($user?->getId())
                ->setName($user?->getName());
        }

        return $result ?? [];
    }
}
