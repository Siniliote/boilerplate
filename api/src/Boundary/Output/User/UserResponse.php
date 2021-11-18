<?php

namespace App\Boundary\Output\User;

use App\Boundary\Output\AbstractResponse;
use App\Boundary\Output\User\Model\UserModel;

class UserResponse extends AbstractResponse
{
    private ?UserModel $data = null;

    public function getData(): ?UserModel
    {
        return $this->data;
    }

    public function setData(UserModel $data): self
    {
        $this->data = $data;

        return $this;
    }
}
