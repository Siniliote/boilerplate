<?php

namespace App\DataTransformer;

use App\Boundary\Input\Post\PostRequest;
use App\Entity\Category;
use App\Entity\Post;

class PostDataTransformer implements DataTransformerInterface
{
    public function transform(PostRequest $request): Post
    {
        $post = (new Post(
            $request->getTitle(),
            $request->getBody(),
            $request->getShortDescription()
        ))->setPublishedAt($request->getPublishedAt())
            ->setViewCount($request->getViewCount());
        if ($category = $request->getCategory()) {
            $post->setCategory(new Category())->setId($category->getId());
        }

        return $post;
    }
}
