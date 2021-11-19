<?php

namespace App\Tests\Unit\UseCase\User;

use App\Boundary\Input\IdRequest;
use App\Boundary\Output\User\UserResponse;
use App\Entity\User;
use App\Tests\Mock\Repository\InMemory\UserRepository;
use App\UseCase\User\FindUserUseCase;
use PHPUnit\Framework\TestCase;

class FindUserUseCaseTest extends TestCase
{
    private const FIRST_NAME = 'Test';

    public function testFindEntityNotFound(): void
    {
        // Arrange
        $request = new IdRequest($id = 1);
        $response = new UserResponse();

        // Act
        $this->buildUseCase(new UserRepository())->execute($request, $response);

        // Assert
        $this->assertSame($response::NOT_FOUND, $response->getStatus());
        $this->assertCount(1, $response->getErrors());
        $this->assertSame("User $id not found", $response->getErrors()[0]);
    }

    public function testFindEntity(): void
    {
        // Arrange
        $repository = new UserRepository();

        $user = (new User())->setName(self::FIRST_NAME);
        $repository->create($user);

        $request = new IdRequest($id = 1);
        $response = new UserResponse();

        // Act
        $this->buildUseCase($repository)->execute($request, $response);

        // Assert
        $this->assertSame($response::OK, $response->getStatus());
        $this->assertCount(0, $response->getErrors());
        $this->assertSame($id, $response->getData()?->getId());
        $this->assertSame(self::FIRST_NAME, $response->getData()?->getName());
    }

    private function buildUseCase(UserRepository $repository): FindUserUseCase
    {
        return new FindUserUseCase($repository);
    }
}
