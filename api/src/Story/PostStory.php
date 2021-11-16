<?php

namespace App\Story;

use App\Entity\Post;
use App\Factory\PostFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\Story;

/**
 * @method static Post|Proxy postA()
 * @method static Post|Proxy postB()
 * @method static Post|Proxy postC()
 */
final class PostStory extends Story
{
    public function build(): void
    {
        $this->add('postA', PostFactory::new()->create([
            'title' => 'Post A',
            'category' => CategoryStory::php(),
        ]));

        $this->add('postB', PostFactory::new()->create([
            'title' => 'Post B',
            'category' => CategoryStory::php(),
        ]));

        $this->add('postC', PostFactory::new([
            'title' => 'Post C',
            'category' => CategoryStory::symfony(),
        ]));

        PostFactory::new()
            ->unpublished()
            ->withViewCount(10)
            ->create([
                'title' => 'Post D',
                'category' => CategoryStory::php(),
            ]);
    }
}
