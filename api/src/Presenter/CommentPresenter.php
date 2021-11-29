<?php

namespace App\Presenter;

use App\Boundary\Output\CommentResponse;
use App\Boundary\Output\ResponseInterface;
use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use App\ViewModel\CommentViewModel;

class CommentPresenter implements PresenterInterface
{
    private ?User $authentication = null;

    private ?User $user = null;

    private ?Post $post = null;

    private ?Comment $comment = null;

    /**
     * @param CommentResponse $response
     */
    public function present(ResponseInterface $response): void
    {
        $this->comment = $response->getComment();
    }

    public function getViewModel(): CommentViewModel
    {
        return new CommentViewModel(
            $this->getUser()?->getName(),
            $this->getPost()?->getTitle(),
            $this->getComment()?->getBody(),
        );
    }

    public function getComment(): ?Comment
    {
        return $this->comment;
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

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(Post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getAuthentication(): ?User
    {
        return $this->authentication;
    }

    public function setAuthentication(User $authentication): self
    {
        $this->authentication = $authentication;

        return $this;
    }
}
