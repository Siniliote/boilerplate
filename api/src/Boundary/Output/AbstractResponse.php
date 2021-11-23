<?php

namespace App\Boundary\Output;

abstract class AbstractResponse implements ResponseInterface, StatusCodeInterface, FormatInterface
{
    private int $status = self::OK;

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

    public function hasErrors(): bool
    {
        return \count($this->errors) > 0;
    }

    /**
     * @return array<string, mixed>
     */
    public function generate(): array
    {
        return [
            'status' => $this->getStatus(),
            'errors' => $this->getErrors(),
            'data' => !$this->hasErrors() ? $this->toDto() : [],
        ];
    }
}
