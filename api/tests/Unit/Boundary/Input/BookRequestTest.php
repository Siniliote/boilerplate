<?php

namespace App\Tests\Unit\Boundary\Input;

use App\Boundary\Input\BookRequest;
use App\Boundary\Input\PageRequest;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BookRequestTest extends KernelTestCase
{
    private const ERROR_EMPTY = 'Cette valeur ne doit pas être vide.';
    private const ERROR_TOO_SHORT = 'Cette chaîne est trop courte. Elle doit avoir au minimum %s caractères.';
    private const ERROR_TOO_LONG = 'Cette chaîne est trop longue. Elle doit avoir au maximum %s caractères.';

    private ValidatorInterface $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $container = self::getContainer();
        $this->validator = $container->get(ValidatorInterface::class);
    }

    public function testBookEntityIsValid(): void
    {
        $bookRequest = $this->createBookEntityValid();

        $this->validBookEntity($bookRequest, 0);
    }

    // <editor-fold Entity Invalid >
    // <editor-fold Path Invalid >
    public function testBookEntityIsNotValidBecausePathIsEmpty(): void
    {
        $bookRequest = $this->createBookEntityValid()->setPath('');

        $errors = $this->validBookEntity($bookRequest, 2);
        $this->assertStringContainsString($errors[0]->getMessage(), self::ERROR_EMPTY);
        $this->assertStringContainsString($errors[1]->getMessage(), sprintf(self::ERROR_TOO_SHORT, 2));
    }

    public function testBookEntityIsNotValidBecausePathIsTooShort(): void
    {
        $bookRequest = $this->createBookEntityValid()->setPath('t');

        $errors = $this->validBookEntity($bookRequest, 1);
        $this->assertStringContainsString($errors[0]->getMessage(), sprintf(self::ERROR_TOO_SHORT, 2));
    }

    public function testBookEntityIsNotValidBecausePathIsTooLarge(): void
    {
        $bookRequest = $this->createBookEntityValid()->setPath('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');

        $errors = $this->validBookEntity($bookRequest, 1);
        $this->assertStringContainsString($errors[0]->getMessage(), sprintf(self::ERROR_TOO_LONG, 100));
    }
    // </editor-fold>

    // <editor-fold Message Invalid >
    public function testBookEntityIsNotValidBecauseMessageIsEmpty(): void
    {
        $bookRequest = $this->createBookEntityValid()->setMessage('');

        // </editor-fold>
        $errors = $this->validBookEntity($bookRequest, 2);
        $this->assertStringContainsString($errors[0]->getMessage(), self::ERROR_EMPTY);
        $this->assertStringContainsString($errors[1]->getMessage(), sprintf(self::ERROR_TOO_SHORT, 2));
    }

    public function testBookEntityIsNotValidBecauseMessageIsTooShort(): void
    {
        $bookRequest = $this->createBookEntityValid()->setMessage('t');

        $errors = $this->validBookEntity($bookRequest, 1);
        $this->assertStringContainsString($errors[0]->getMessage(), sprintf(self::ERROR_TOO_SHORT, 2));
    }

    public function testBookEntityIsNotValidBecauseMessageIsTooLarge(): void
    {
        $bookRequest = $this->createBookEntityValid()->setMessage('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');

        $errors = $this->validBookEntity($bookRequest, 1);
        $this->assertStringContainsString($errors[0]->getMessage(), sprintf(self::ERROR_TOO_LONG, 50));
    }

    // </editor-fold>

    public function testBookEntityIsNotValid(): void
    {
        $bookRequest = $this->createBookEntityValid()->setPath('')->setMessage('');

        $this->validBookEntity($bookRequest, 4);
    }

    // </editor-fold>
    private function validBookEntity(BookRequest $bookRequest, int $numberOfError): ConstraintViolationListInterface
    {
        $errors = $this->validator->validate($bookRequest);

        $this->assertCount($numberOfError, $errors);

        return $errors;
    }

    private function createBookEntityValid(): BookRequest
    {
        $pageRequest = (new PageRequest())->setNumber(1)->setTitle('test');

        return (new BookRequest())
            ->setPath('test')
            ->setMessage('test')
            ->addPage($pageRequest);
    }
}
