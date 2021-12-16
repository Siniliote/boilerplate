<?php

namespace App\Boundary\Output;

use App\Entity\Comment;

class CommentResponse implements ResponseInterface
{
    public function __construct(
        private Comment $comment,
    ) {
    }

    public function getComment(): Comment
    {
        return $this->comment;
    }

    public function setComment(Comment $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}
