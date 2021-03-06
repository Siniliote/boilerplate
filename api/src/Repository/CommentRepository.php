<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Gateway\CommentGateway;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method void         create(Comment $entity)
 * @method void         delete(Comment $entity)
 *
 * @psalm-method list<Comment> findAll()
 * @psalm-method list<Comment> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @template-extends AbstractRepository<Comment>
 */
final class CommentRepository extends AbstractRepository implements CommentGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }
}
