<?php

namespace App\Boundary\Input;

class BookRequest
{
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
