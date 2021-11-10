<?php

namespace App\Boundary\Input;

use Symfony\Component\Validator\Constraints as Assert;

class BookRequest
{
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Your first name must be at least {{ limit }} characters long',
        maxMessage: 'Your first name cannot be longer than {{ limit }} characters',
    )]
    private string $message;
    private string $path;
    private array $pages;

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getPages(): array
    {
        return $this->pages;
    }

    public function addPage(PageRequest $page): self
    {
        $this->pages[] = $page;

        return $this;
    }

    public function setPages(array $pages): self
    {
        $this->pages = $pages;

        return $this;
    }
}
