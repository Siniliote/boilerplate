<?php

namespace App\Boundary\Output;

use App\Entity\Category;

class CategoryResponse implements ResponseInterface
{
    public function __construct(
        private Category $category,
    ) {
    }

    public function getCategory(): Category
    {
        return $this->category;
    }
}
