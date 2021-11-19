<?php

namespace App\Tests\Unit\UseCase\User;

use App\Boundary\Input\User\UserRequest;
use App\Boundary\Output\User\UserResponse;
use App\DataTransformer\UserDataTransformer;
use App\Tests\Mock\Repository\InMemory\UserRepository;
use App\UseCase\User\PostUserUseCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostUserUseCaseTest extends KernelTestCase
{
    private const ERROR_EMPTY = 'Cette valeur ne doit pas être vide.';
    private const ERROR_TOO_SHORT = 'Cette chaîne est trop courte. Elle doit avoir au minimum 2 caractères.';
    private const ERROR_TOO_LONG = 'Cette chaîne est trop longue. Elle doit avoir au maximum 50 caractères.';

    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $container = self::getContainer();
        $this->validator = $container->get(ValidatorInterface::class);
    }

    public function testWithValidEntity(): void
    {
        // Arrange
        $request = (new UserRequest())->setName($name = 'Test');
        $response = new UserResponse();

        // Act
        $this->act($request, $response);

        // Assert
        $this->assertSame($response::OK, $response->getStatus());
        $this->assertCount(0, $response->getErrors());
        $this->assertSame(1, $response->getData()?->getId());
        $this->assertSame($name, $response->getData()?->getName());
    }

    public function testWithNameEmpty(): void
    {
        // Arrange
        $request = (new UserRequest())->setName('');
        $response = new UserResponse();

        // Act
        $this->act($request, $response);

        // Assert
        $this->assertSame($response::BAD_REQUEST, $response->getStatus());
        $this->assertCount(2, $response->getErrors());
        $this->assertSame(self::ERROR_EMPTY, $response->getErrors()[0]);
        $this->assertSame(self::ERROR_TOO_SHORT, $response->getErrors()[1]);
    }

    public function testWithNameTooShort(): void
    {
        // Arrange
        $request = (new UserRequest())->setName('T');
        $response = new UserResponse();

        // Act
        $this->act($request, $response);

        // Assert
        $this->assertSame($response::BAD_REQUEST, $response->getStatus());
        $this->assertCount(1, $response->getErrors());
        $this->assertSame(self::ERROR_TOO_SHORT, $response->getErrors()[0]);
    }

    public function testWithNameTooLong(): void
    {
        // Arrange
        $request = (new UserRequest())->setName("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.");
        $response = new UserResponse();

        // Act
        $this->act($request, $response);

        // Assert
        $this->assertSame($response::BAD_REQUEST, $response->getStatus());
        $this->assertCount(1, $response->getErrors());
        $this->assertSame(self::ERROR_TOO_LONG, $response->getErrors()[0]);
    }

    private function buildUseCase(): PostUserUseCase
    {
        return new PostUserUseCase($this->validator, new UserRepository(), new UserDataTransformer());
    }

    private function act(UserRequest $request, UserResponse $response): void
    {
        $this->buildUseCase()->execute($request, $response);
    }
}
