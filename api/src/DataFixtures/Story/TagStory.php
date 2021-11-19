<?php

namespace App\DataFixtures\Story;

use App\DataFixtures\Factory\TagFactory;
use App\Entity\Tag;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\Story;

/**
 * @method static Tag|Proxy dev()
 * @method static Tag|Proxy design()
 */
final class TagStory extends Story
{
    public function build(): void
    {
        $this->add('dev', TagFactory::new()->create(['name' => 'dev']));
        $this->add('design', TagFactory::new()->create(['name' => 'design']));
    }
}
