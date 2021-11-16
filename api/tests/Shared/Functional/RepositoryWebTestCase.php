<?php

declare(strict_types=1);

namespace App\Tests\Shared\Functional;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

abstract class RepositoryWebTestCase extends WebTestCase
{
    use Factories;
    use ResetDatabase;

    protected ServiceEntityRepository $repository;
    protected ?ObjectManager $entityManager;

    /**
     * @phpstan-return class-string
     */
    abstract protected function getRepositoryClass(): string;

    public function getRepository(): ObjectRepository
    {
        return $this->repository;
    }

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        /** @var Registry $managerRegistry */
        $managerRegistry = $kernel->getContainer()->get('doctrine');
        $this->entityManager = $managerRegistry->getManager();

        $repositoryClass = $this->getRepositoryClass();
        $this->repository = new $repositoryClass($managerRegistry);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager?->close();
        $this->entityManager = null;
    }
}
