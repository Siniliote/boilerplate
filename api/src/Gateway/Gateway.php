<?php

namespace App\Gateway;

/**
 * @template T
 */
interface Gateway
{
    /**
     * Finds an entity by its primary key / identifier.
     *
     * @param mixed    $id          the identifier
     * @param int|null $lockMode    one of the \Doctrine\DBAL\LockMode::* constants
     *                              or NULL if no specific lock mode should be used
     *                              during the search
     * @param int|null $lockVersion the lock version
     *
     * @return object|null the entity instance or NULL if the entity can not be found
     * @psalm-return ?T
     */
    public function find($id, $lockMode = null, $lockVersion = null);

    /**
     * Finds a single entity by a set of criteria.
     *
     * @psalm-param array<string, mixed> $criteria
     * @psalm-param array<string, string>|null $orderBy
     *
     * @return object|null the entity instance or NULL if the entity can not be found
     * @psalm-return ?T
     */
    public function findOneBy(array $criteria, array $orderBy = null);

    /**
     * Finds all entities in the repository.
     *
     * @psalm-return list<T> The entities.
     */
    public function findAll();

    /**
     * Finds entities by a set of criteria.
     *
     * @param int|null $limit
     * @param int|null $offset
     * @psalm-param array<string, mixed> $criteria
     * @psalm-param array<string, string>|null $orderBy
     *
     * @return object[] the objects
     * @psalm-return list<T>
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);
}
