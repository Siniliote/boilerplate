<?php

namespace App\Repository;

use App\Entity\Contact;
use App\Gateway\ContactGateway;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @psalm-method list<Contact> findAll()
 * @psalm-method list<Contact> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @template-extends AbstractRepository<Contact>
 */
final class ContactRepository extends AbstractRepository implements ContactGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }
}
