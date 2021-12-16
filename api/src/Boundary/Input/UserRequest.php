<?php

namespace App\Boundary\Input;

use Symfony\Component\Validator\Constraints as Assert;

class UserRequest implements RequestInterface
{
    public function __construct(
        #[Assert\NotBlank] #[Assert\Length(min: 2, max: 50)] private string $name,
    ) {
    }

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
