<?php

namespace App\Boundary\Input\User;

use App\Boundary\Input\RequestInterface;
use Symfony\Component\Validator\Constraints as Assert;

class UserRequest implements RequestInterface
{
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
    )]
    private string $name = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
