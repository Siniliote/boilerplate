<?php

namespace App\Boundary\Output;

interface ResponseInterface
{
    public function getStatus(): int;

    public function setStatus(int $status): self;

    /** @return array<int, string> */
    public function getErrors(): array;

    /** @param array<int, string> $errors */
    public function setErrors(array $errors): self;

    public function addError(string $error): self;
}
