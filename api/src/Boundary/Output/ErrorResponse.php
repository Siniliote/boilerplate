<?php

namespace App\Boundary\Output;

final class ErrorResponse implements ResponseInterface, StatusCodeInterface
{
    public function __construct(
        private string $context,
        private int $statusCode = self::BAD_REQUEST,
        private array $errors = [],
    ) {
    }

    public function getContext(): string
    {
        return $this->context;
    }

    public function setContext(string $context): self
    {
        $this->context = $context;

        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function getErrors(): ?array
    {
        return $this->errors;
    }

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
}
