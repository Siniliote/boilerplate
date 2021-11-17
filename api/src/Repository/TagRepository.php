<?php

namespace App\Repository;

use App\Entity\Tag;
use App\Gateway\TagGateway;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tag|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tag|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tag[]    findAll()
 * @method Tag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @psalm-method list<Tag> findAll()
 * @psalm-method list<Tag> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @template-extends AbstractRepository<Tag>
 */
final class TagRepository extends AbstractRepository implements TagGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }
}
