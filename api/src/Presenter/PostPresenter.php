<?php

namespace App\Presenter;

use App\Boundary\Output\PostResponse;
use App\Boundary\Output\ResponseInterface;
use App\Entity\Category;
use App\Entity\Post;
use App\Entity\User;
use App\ViewModel\PostViewModel;
use DateTimeInterface;

class PostPresenter implements PresenterInterface
{
    private ?Category $category = null;

    private ?Post $post = null;

    private ?User $user = null;

    /**
     * @param PostResponse $response
     *
     * @throws \Exception
     */
    public function present(ResponseInterface $response): void
    {
        $this->post = $response->getPost();
        $this->category = $response->getPost()->getCategory();
    }

    public function getViewModel(): PostViewModel
    {
        return new PostViewModel(
            $this->getPost()->getTitle(),
            $this->getPost()->getBody(),
            $this->getPost()->getCreatedAt()->format(DateTimeInterface::RFC3339),
            $this->getPost()->getShortDescription(),
            $this->getPost()->getViewCount(),
            $this->getPost()->getPublishedAt()?->format(DateTimeInterface::RFC3339),
            $this->getCategory()?->getName()
        );
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
