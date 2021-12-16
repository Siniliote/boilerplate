<?php

namespace App\UseCase\Category;

use App\Boundary\Input\IdRequest;
use App\Boundary\Input\RequestInterface;
use App\Boundary\Output\CategoryResponse;
use App\Exception\InvalidRequestException;
use App\Exception\NotFoundResourceException;
use App\Gateway\CategoryGateway;
use App\Presenter\PresenterInterface;
use App\UseCase\AbstractUseCase;
use App\UseCase\UseCaseInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FindCategoryUseCase extends AbstractUseCase implements UseCaseInterface
{
    public function __construct(
        protected ValidatorInterface $validator,
        private CategoryGateway $gateway,
    ) {
        parent::__construct($validator);
    }

    /**
     * @param IdRequest $request
     *
     * @throws NotFoundResourceException
     * @throws InvalidRequestException
     */
    public function execute(RequestInterface $request, PresenterInterface $presenter): void
    {
        $this->isValid($request);

        $category = $this->gateway->find($request->getId());

        if (!$category) {
            throw new NotFoundResourceException('Category not found');
        }

        $presenter->present(new CategoryResponse($category));
    }
}
