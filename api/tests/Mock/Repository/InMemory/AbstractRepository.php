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
    protected array $data = [];

    /**
     * {@inheritDoc}
     */
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        $entities = array_filter($this->data, function ($entity) use ($id) {
            return $entity->getId() === $id;
        });

        return $entities[0] ?? null;
    }

    /**
     * {@inheritDoc}
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        $entities = array_filter($this->data, function ($entity) use ($criteria) {
            return $entity->getId() === $criteria['id'];
        });

        return $entities[0] ?? null;
    }

    /**
     * {@inheritDoc}
     */
    public function findAll()
    {
        return $this->data;
    }

    /**
     * {@inheritDoc}
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->data;
    }

    /**
     * {@inheritDoc}
     */
    public function create($entity)
    {
        $entity->setId(\count($this->data) + 1);
        $this->data[] = $entity;
    }
}
