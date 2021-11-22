<?php

namespace App\Boundary\Output\Post;

use App\Boundary\Output\AbstractResponse;
use App\Dto\PostDto;
use App\Entity\Post;

class PostResponse extends AbstractResponse
{
    private ?Post $data = null;

    /**
     * @return ?Post
     */
    public function getData(): ?Post
    {
        return $this->data;
    }

    public function setData(?Post $data): self
    {
        $this->data = $data;

        return $this;
    }

    protected function toDto(): PostDto
    {
        $data = $this->getData();

        return (new PostDto($data->getTitle(), $data->getBody(), $data->getShortDescription()))
            ->setId($data->getId())
            ->setViewCount($data->getViewCount())
            ->setPublishedAt($data->getPublishedAt());
    }
}
