<?php

namespace App\UseCase\Category;

use App\Boundary\Input\IdRequest;
use App\Boundary\Input\RequestInterface;
use App\Boundary\Output\Category\CategoryResponse;
use App\Boundary\Output\ResponseInterface;
use App\Gateway\CategoryGateway;
use App\UseCase\UseCaseInterface;

class FindCategoryUseCase implements UseCaseInterface
{
    public function __construct(private CategoryGateway $gateway)
    {
    }

    /**
     * @param IdRequest        $request
     * @param CategoryResponse $response
     */
    public function execute(RequestInterface $request, ResponseInterface $response): void
    {
        $category = $this->gateway->find($request->getId());
        if (!$category) {
            $response
                ->setStatus($response::NOT_FOUND)
                ->addError('Category '.$request->getId().' not found');

            return;
        }

        $response->setData($category);
    }
}
