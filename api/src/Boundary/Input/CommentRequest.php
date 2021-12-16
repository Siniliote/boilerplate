<?php

namespace App\Boundary\Input;

use App\Request\ParamConverter\JsonBodySerializableInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CommentRequest implements RequestInterface, JsonBodySerializableInterface
{
    public function __construct(
        #[Assert\NotBlank] #[Assert\Length(min: 2, max: 50)] private string $body,
    ) {
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }
}
