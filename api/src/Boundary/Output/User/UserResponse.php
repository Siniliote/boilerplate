<?php

namespace App\Boundary\Output\User;

use App\Boundary\Output\AbstractObjectResponse;
use App\Dto\DtoInterface;
use App\Dto\UserDto;
use App\Entity\User;

/**
 * @template-extends AbstractObjectResponse<User>
 */
class UserResponse extends AbstractObjectResponse
{
    /**
     * @return UserDto
     */
    protected function getDto(): DtoInterface
    {
        return (new UserDto())
            ->setId($this->getData()?->getId())
            ->setName($this->getData()?->getName());
    }
}
