<?php

namespace App\Boundary\Output\User;

use App\Boundary\Output\AbstractListResponse;
use App\Dto\DtoInterface;
use App\Dto\UserDto;
use App\Entity\User;

/**
 * @template-extends AbstractListResponse<User>
 */
class UserListResponse extends AbstractListResponse
{
    /**
     * @param User $entity
     *
     * @return UserDto
     */
    protected function getDto($entity): DtoInterface
    {
        return (new UserDto())
            ->setId($entity->getId())
            ->setName($entity->getName());
    }
}
