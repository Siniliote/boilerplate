<?php

namespace App\Boundary\Input\Comment;

use App\Boundary\Input\IdRequest;
use App\Boundary\Input\RequestInterface;
use App\Request\ParamConverter\JsonBodySerializableInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CommentRequest implements RequestInterface, JsonBodySerializableInterface
{
    private ?IdRequest $user;

    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
    )]
    private string $body = '';

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
