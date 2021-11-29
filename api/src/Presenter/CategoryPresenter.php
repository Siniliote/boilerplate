<?php

namespace App\Presenter;

use App\Boundary\Output\CategoryResponse;
use App\Boundary\Output\ResponseInterface;
use App\Entity\Category;
use App\ViewModel\CategoryViewModel;

class CategoryPresenter implements PresenterInterface
{
    public ?Category $category;

    /**
     * @param CategoryResponse $response
     */
    public function present(ResponseInterface $response): void
    {
        $this->category = $response->getCategory();
    }

    public function getViewModel(): CategoryViewModel
    {
        return new CategoryViewModel(
            $this->getCategory()?->getName(),
        );
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }
}
