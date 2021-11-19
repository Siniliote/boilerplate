<?php

namespace App\Tests\Unit\UseCase\Post;

use App\Boundary\Input\Post\PostRequest;
use App\Boundary\Output\Post\PostResponse;
use App\DataTransformer\PostDataTransformer;
use App\Tests\Mock\Repository\InMemory\CategoryRepository;
use App\Tests\Mock\Repository\InMemory\PostRepository;
use App\Tests\Mock\Repository\InMemory\TagRepository;
use App\UseCase\Post\PostPostUseCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostPostUseCaseTest extends KernelTestCase
{
    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $container = self::getContainer();
        $this->validator = $container->get(ValidatorInterface::class);
    }

    public function testWithValidEntityWithoutCategory(): void
    {
        // Arrange
        $postRepository = new PostRepository();
        $categoryRepository = new CategoryRepository();
        $tagRepository = new TagRepository();

        $response = new PostResponse();
        // Act
        $this->buildUseCase($postRepository, $categoryRepository, $tagRepository)->execute($this->createValidPostRequest(), $response);

        // Assert
        $this->assertSame($response::OK, $response->getStatus());
        $this->assertCount(0, $response->getErrors());
    }

    public function testWithValidEntityWithCategoryNotFound(): void
    {
        // Arrange
        $postRepository = new PostRepository();
        $categoryRepository = new CategoryRepository();
        $tagRepository = new TagRepository();

        $request = $this->createValidPostRequest()
            ->setCategory(1);
        $response = new PostResponse();
        $this->buildUseCase($postRepository, $categoryRepository, $tagRepository)->execute($request, $response);

        $this->assertSame($response::NOT_FOUND, $response->getStatus());
        $this->assertCount(1, $response->getErrors());
        $this->assertStringContainsString('Category not found', $response->getErrors()[0]);
    }

    private function createValidPostRequest(): PostRequest
    {
        return (new PostRequest())->setTitle('Test')
            ->setBody('Test')
            ->setShortDescription('Test')
            ->setPublishedAt(new \DateTime())
            ->setViewCount(1);
    }

    private function buildUseCase(
        PostRepository $postRepository,
        CategoryRepository $categoryRepository,
        TagRepository $tagRepository
    ): PostPostUseCase {
        return new PostPostUseCase(
            $this->validator,
            $postRepository,
            $categoryRepository,
            $tagRepository,
            new PostDataTransformer()
        );
    }
}
