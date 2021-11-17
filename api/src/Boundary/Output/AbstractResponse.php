<?php

namespace App\Boundary\Output;

use Symfony\Component\HttpFoundation\Response;

abstract class AbstractResponse implements ResponseInterface
{
    private int $status = Response::HTTP_OK;

    /** @var array<int, string> */
    private array $errors = [];

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /** {@inheritDoc} */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /** {@inheritDoc} */
    public function setErrors(array $errors): self
    {
        $this->errors = $errors;

        return $this;
    }

    public function addError(string $error): self
    {
        $this->errors[] = $error;

        return $this;
    }
}
