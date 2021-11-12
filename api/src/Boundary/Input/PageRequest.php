<?php

namespace App\Boundary\Input;

use Symfony\Component\Validator\Constraints as Assert;

class PageRequest
{
    #[Assert\NotBlank]
    #[Assert\Positive]
    private int $number;

    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
    )]
    private string $title;

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
