<?php

namespace App\Adapter\Response;

use App\Boundary\Output\Post\Model\CategoryModel;
use App\Boundary\Output\Post\Model\PostModel;
use App\Boundary\Output\Post\Model\TagModel;
use App\Entity\Post;
use App\Entity\Tag;

class PostModelAdapter
{
    public function adapte(Post $post): PostModel
    {
        if ($post->getCategory()) {
            $category = (new CategoryModel())->setId($post->getCategory()->getId())
                ->setName($post->getCategory()->getName());
        }
        /** @var Tag $tag */
        foreach ($post->getTags() as $tag) {
            $tags[] = (new TagModel())->setId($tag->getId())->setName($tag->getName());
        }

        return (new PostModel($post->getTitle(), $post->getBody(), $post->getShortDescription()))
            ->setId($post->getId())
            ->setViewCount($post->getViewCount())
            ->setCreatedAt($post->getCreatedAt())
            ->setPublishedAt($post->getPublishedAt())
            ->setCategory($category ?? null)
            ->setTags($tags ?? []);
    }
}
