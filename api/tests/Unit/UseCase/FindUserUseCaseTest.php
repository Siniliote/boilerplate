<?php

namespace App\Tests\Unit\UseCase;

use App\Boundary\Input\IdRequest;
use App\Boundary\Output\User\UserResponse;
use App\Entity\User;
use App\Hydrator\Response\UserHydrator;
use App\Tests\Mock\Repository\InMemory\UserRepository;
use App\UseCase\User\FindUserUseCase;
use PHPUnit\Framework\TestCase;

class FindUserUseCaseTest extends TestCase
{
    public function testFindEntityNotFound(): void
    {
        $request = new IdRequest($id = 1);
        $response = new UserResponse();
        $this->buildUseCase(new UserRepository())->execute($request, $response);

        $this->assertSame($response::NOT_FOUND, $response->getStatus());
        $this->assertCount(1, $response->getErrors());
        $this->assertSame("User $id not found", $response->getErrors()[0]);
    }

    public function testFindEntity(): void
    {
        $user = (new User())->setName($name = 'Test');
        $repository = new UserRepository();
        $repository->create($user);

        $request = new IdRequest($id = 1);
        $response = new UserResponse();
        $this->buildUseCase($repository)->execute($request, $response);

        $this->assertSame($response::OK, $response->getStatus());
        $this->assertCount(0, $response->getErrors());
        $this->assertSame($id, $response->getId());
        $this->assertSame($name, $response->getName());
    }

    private function buildUseCase(UserRepository $repository): FindUserUseCase
    {
        return new FindUserUseCase($repository, new UserHydrator());
    }
}
