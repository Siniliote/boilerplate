<?php

namespace App\Boundary\Output\User;

use App\Boundary\Output\AbstractResponse;
use App\Boundary\Output\User\Model\UserModel;

class UserListResponse extends AbstractResponse
{
    /** @var UserModel[] */
    private array $data = [];

    /** @return UserModel[] */
    public function getData(): array
    {
        return $this->data;
    }

    /** @param UserModel[] $data */
    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function addData(UserModel $userModel): self
    {
        $this->data[] = $userModel;

        return $this;
    }
}
