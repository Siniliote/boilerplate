<?php

namespace App\Tests\Mock\Repository\InMemory;

use App\Gateway\Gateway;

/**
 * @template T
 * @template-implements Gateway<T>
 */
abstract class AbstractRepository implements Gateway
{
    /**
     * @var array<int, T>
     */
    protected array $inMemory = [];

    /**
     * {@inheritDoc}
     */
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        $entities = array_filter($this->inMemory, function ($entity) use ($id) {
            return $entity->getId() === $id;
        });

        return $entities[0] ?? null;
    }

    /**
     * {@inheritDoc}
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        $entities = array_filter($this->inMemory, function ($entity) use ($criteria) {
            return $entity->getId() === $criteria['id'];
        });

        return $entities[0] ?? null;
    }

    /**
     * {@inheritDoc}
     */
    public function findAll()
    {
        return $this->inMemory;
    }

    /**
     * {@inheritDoc}
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->inMemory;
    }

    /**
     * {@inheritDoc}
     */
    public function create($entity)
    {
        $entity->setId(\count($this->inMemory) + 1);
        $this->inMemory[] = $entity;
    }
}
