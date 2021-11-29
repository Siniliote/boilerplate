<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * @template T
 * @extends ServiceEntityRepository<T>
 */
abstract class AbstractRepository extends ServiceEntityRepository
{
    /**
     * @var string
     * @psalm-suppress PropertyNotSetInConstructor
     */
    protected $_entityName;

    /**
     * @var EntityManagerInterface
     * @psalm-suppress PropertyNotSetInConstructor
     */
    protected $_em;

    /**
     * @var ClassMetadata
     * @psalm-suppress PropertyNotSetInConstructor
     */
    protected $_class;

    /**
     * @param object $entity
     * @psalm-param object<T> $entity
     *
     * @throws OptimisticLockException
     * @throws MissingMappingDriverImplementation|ORMException
     */
    public function create($entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @param object $entity
     * @psalm-param object<T> $entity
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete($entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}
