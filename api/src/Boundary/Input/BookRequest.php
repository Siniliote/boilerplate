<?php

namespace App\Boundary\Input;

use Symfony\Component\Validator\Constraints as Assert;

class BookRequest
{
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
    )]
    private string $message;

    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 100,
    )]
    private string $path;
    /** @var PageRequest[] */
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

    /** @return PageRequest[] */
    public function getPages(): array
    {
        return $this->pages;
    }

    public function addPage(PageRequest $page): self
    {
        $this->pages[] = $page;

        return $this;
    }

    /** @param PageRequest[] $pages */
    public function setPages(array $pages): self
    {
        $this->pages = $pages;

        return $this;
    }
}
