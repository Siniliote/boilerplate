<?php

namespace App\Tests\Unit\UseCase\User;

use App\Adapter\Response\UserModelAdapter;
use App\Boundary\Input\EmptyRequest;
use App\Boundary\Output\User\UserListResponse;
use App\Tests\Mock\Repository\InMemory\UserRepository;
use App\Tests\Unit\Utils\CreateUserTrait;
use App\UseCase\User\FindAllUserUseCase;
use PHPUnit\Framework\TestCase;

class FindAllUserUseCaseTest extends TestCase
{
    use CreateUserTrait;

    private const FIRST_NAME = 'Test';
    private const SECOND_NAME = 'Test2';

    public function testFindAllEmpty(): void
    {
        // Arrange
        $request = new EmptyRequest();
        $response = new UserListResponse();

        // Act
        $this->buildUseCase(new UserRepository())->execute($request, $response);

        // Assert
        $this->assertSame($response::OK, $response->getStatus());
        $this->assertCount(0, $response->getErrors());
        $this->assertCount(0, $response->getData());
    }

    public function testFindOneEntity(): void
    {
        $tests = [
            self::FIRST_NAME,
        ];
        $this->testFindSeveralEntities($tests);
    }

    public function testFindTwoEntity(): void
    {
        $tests = [
            self::FIRST_NAME,
            self::SECOND_NAME,
        ];
        $this->testFindSeveralEntities($tests);
    }

    /**
     * @param array<int, string> $tests
     */
    private function testFindSeveralEntities(array $tests): void
    {
        // Arrange
        $repository = new UserRepository();
        foreach ($tests as $test) {
            $this->createUserEntity($repository, $test);
        }

        $request = new EmptyRequest();
        $response = new UserListResponse();

        // Act
        $this->buildUseCase($repository)->execute($request, $response);

        // Assert
        $this->assertSame($response::OK, $response->getStatus());
        $this->assertCount(0, $response->getErrors());
        $this->assertCount(\count($tests), $response->getData());

        foreach ($tests as $key => $test) {
            $this->assertSame(($key + 1), $response->getData()[$key]->getId());
            $this->assertSame($test, $response->getData()[$key]->getName());
        }
    }

    private function buildUseCase(UserRepository $repository): FindAllUserUseCase
    {
        return new FindAllUserUseCase($repository, new UserModelAdapter());
    }
}
