<?php

declare(strict_types=1);

namespace App\Tests\Functional\Repository;

use App\Repository\PostRepository;
use App\Story\PostStory;
use App\Tests\Shared\Functional\AbstractRepositoryWebTestCase;

class PostAbstractRepositoryTest extends AbstractRepositoryWebTestCase
{
    protected function getRepositoryClass(): string
    {
        return PostRepository::class;
    }

    public function testFindAll(): void
    {
        // 1. "Arrange"
        PostStory::load();

        // 2. "Act"
        $posts = $this->getRepository()->findAll();

        // 3. "Assert"
        $this->assertCount(4, $posts);
    }
}
