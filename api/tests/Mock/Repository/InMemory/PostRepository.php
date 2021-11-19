<?php

namespace App\Tests\Mock\Repository\InMemory;

use App\Entity\Post;
use App\Gateway\PostGateway;

/**
 * @template-extends AbstractRepository<Post>
 */
class PostRepository extends AbstractRepository implements PostGateway
{
}
