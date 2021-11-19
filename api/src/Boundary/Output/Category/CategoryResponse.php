<?php

namespace App\Boundary\Output\Category;

use App\Boundary\Output\AbstractObjectResponse;
use App\Dto\CategoryDto;
use App\Dto\DtoInterface;
use App\Entity\Category;

/**
 * @template-extends AbstractObjectResponse<Category>
 */
class CategoryResponse extends AbstractObjectResponse
{
    /**
     * @return CategoryDto
     */
    protected function getDto(): DtoInterface
    {
        return (new CategoryDto())
            ->setId($this->getData()?->getId())
            ->setName($this->getData()?->getName());
    }
}
