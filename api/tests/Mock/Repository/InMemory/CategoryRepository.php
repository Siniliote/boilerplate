<?php

namespace App\Tests\Mock\Repository\InMemory;

use App\Entity\Category;
use App\Gateway\CategoryGateway;

/**
 * @template-extends AbstractRepository<Category>
 */
class CategoryRepository extends AbstractRepository implements CategoryGateway
{
}
