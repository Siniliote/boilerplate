<?php

namespace App\Tests\Mock\Repository\InMemory;

use App\Entity\Tag;
use App\Gateway\TagGateway;

/**
 * @template-extends AbstractRepository<Tag>
 */
class TagRepository extends AbstractRepository implements TagGateway
{
}
