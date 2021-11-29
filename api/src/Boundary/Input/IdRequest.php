<?php

namespace App\Boundary\Input;

use App\Request\ParamConverter\JsonBodySerializableInterface;

class IdRequest implements RequestInterface, JsonBodySerializableInterface
{
    public function __construct(
        private int $id,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }
}
