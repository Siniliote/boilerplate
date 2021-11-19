<?php

namespace App\DataTransformer;

use App\Boundary\Input\Post\PostRequest;
use App\Dto\CategoryDto;
use App\Dto\PostDto;
use App\Dto\TagDto;
use App\Entity\Post;
use App\Entity\Tag;

class PostDataTransformer implements DataTransformerInterface
{
    public function transform(PostRequest $request): Post
    {
        return (new Post(
            $request->getTitle(),
            $request->getBody(),
            $request->getShortDescription()
        ))->setPublishedAt($request->getPublishedAt())
            ->setViewCount($request->getViewCount());
    }

    public function reverseTransform(Post $post): PostDto
    {
        if ($category = $post->getCategory()) {
            $category = (new CategoryDto())->setId($category->getId())
                ->setName($category->getName());
        }
        /** @var Tag $tag */
        foreach ($post->getTags() as $tag) {
            $tags[] = (new TagDto())->setId($tag->getId())->setName($tag->getName());
        }

        return (new PostDto($post->getTitle(), $post->getBody(), $post->getShortDescription()))
            ->setId($post->getId())
            ->setViewCount($post->getViewCount())
            ->setCreatedAt($post->getCreatedAt())
            ->setPublishedAt($post->getPublishedAt())
            ->setCategory($category ?? null)
            ->setTags($tags ?? []);
    }
}
