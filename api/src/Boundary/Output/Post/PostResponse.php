<?php

namespace App\Boundary\Output\Post;

use App\Boundary\Output\AbstractResponse;
use App\Boundary\Output\Post\Model\PostModel;

class PostResponse extends AbstractResponse
{
    private ?PostModel $data = null;

    public function getData(): ?PostModel
    {
        return $this->data;
    }

    public function setData(PostModel $data): self
    {
        $this->data = $data;

        return $this;
    }
}
