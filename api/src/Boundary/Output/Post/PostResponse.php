<?php

namespace App\Boundary\Output\Post;

use App\Boundary\Output\AbstractObjectResponse;
use App\Dto\DtoInterface;
use App\Dto\PostDto;
use App\Entity\Post;

/**
 * @template-extends AbstractObjectResponse<Post>
 */
class PostResponse extends AbstractObjectResponse
{
    /**
     * @return PostDto
     */
    protected function getDto(): DtoInterface
    {
        $data = $this->getData();

        return (new PostDto($data->getTitle(), $data->getBody(), $data->getShortDescription()))
            ->setId($data->getId())
            ->setViewCount($data->getViewCount())
            ->setPublishedAt($data->getPublishedAt());
    }
}
