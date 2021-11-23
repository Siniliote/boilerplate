<?php

namespace App\Boundary\Output\Category;

use App\Boundary\Output\AbstractResponse;
use App\Dto\CategoryDto;
use App\Entity\Category;

class CategoryResponse extends AbstractResponse
{
    private ?Category $data = null;

    public function getData(): ?Category
    {
        return $this->data;
    }

    public function setData(?Category $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function toDto(): CategoryDto
    {
        return (new CategoryDto())
            ->setId($this->getData()?->getId())
            ->setName($this->getData()?->getName());
    }
}
