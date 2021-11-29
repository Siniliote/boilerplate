<?php

namespace App\Boundary\Output;

use App\Entity\Post;

class PostResponse implements ResponseInterface
{
    public function __construct(
        private Post $post,
    ) {
    }

    public function getPost(): Post
    {
        return $this->post;
    }

    public function setPost(Post $post): self
    {
        $this->post = $post;

        return $this;
    }
}
