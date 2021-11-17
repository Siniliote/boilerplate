<?php

namespace App\Tests\Mock\Repository\InMemory;

use App\Entity\User;
use App\Gateway\UserGateway;

class UserRepository implements UserGateway
{
    /** @var User[] */
    private array $users = [];

    /**
     * {@inheritDoc}
     */
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        /** @var User[] $users */
        $users = array_filter($this->users, function ($user) use ($id) {
            return $user->getId() === $id;
        });

        return $users[0] ?? null;
    }

    /**
     * @inheritDocUser
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        /** @var User[] $users */
        $users = array_filter($this->users, function ($user) use ($criteria) {
            return $user->getId() === $criteria['id'];
        });

        return $users[0] ?? null;
    }

    /**
     * {@inheritDoc}
     */
    public function findAll()
    {
        return $this->users;
    }

    /**
     * {@inheritDoc}
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->users;
    }

    /**
     * @param User $entity
     *
     * @return void
     */
    public function create($entity)
    {
        $entity->setId(\count($this->users) + 1);
        $this->users[] = $entity;
    }
}
