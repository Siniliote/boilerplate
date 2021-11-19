<?php

namespace App\Tests\Unit\UseCase\Post;

use App\Boundary\Input\Category\CategoryRequest;
use App\Boundary\Input\Post\PostRequest;
use App\Boundary\Output\Post\PostResponse;
use App\Tests\Mock\Repository\InMemory\CategoryRepository;
use App\Tests\Mock\Repository\InMemory\PostRepository;
use App\UseCase\Category\FindCategoryUseCase;
use App\UseCase\Post\PostPostUseCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostPostUseCaseTest extends KernelTestCase
{
    private PostPostUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        $container = self::getContainer();

        $this->useCase = new PostPostUseCase(
            $container->get(ValidatorInterface::class),
            new PostRepository(),
            new FindCategoryUseCase(new CategoryRepository())
        );
    }

    public function testWithValidEntityWithoutCategory(): void
    {
        // Arrange
        $response = new PostResponse();
        // Act
        $this->useCase->execute($this->createValidPostRequest(), $response);

        // Assert
        $this->assertSame($response::OK, $response->getStatus());
        $this->assertCount(0, $response->getErrors());
    }

    public function testWithValidEntityWithCategoryNotFound(): void
    {
        // Arrange
        $request = $this->createValidPostRequest()
            ->setCategory(new CategoryRequest(1));
        $response = new PostResponse();
        $this->useCase->execute($request, $response);

        $this->assertSame($response::BAD_REQUEST, $response->getStatus());
        $this->assertCount(1, $response->getErrors());
        $this->assertStringContainsString('Category 1 not found', $response->getErrors()[0]);
    }

    private function createValidPostRequest(): PostRequest
    {
        return (new PostRequest())->setTitle('Test')
            ->setBody('Test')
            ->setShortDescription('Test')
            ->setPublishedAt(new \DateTime())
            ->setViewCount(1);
    }
}
