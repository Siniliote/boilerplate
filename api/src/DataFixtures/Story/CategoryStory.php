<?php

namespace App\DataFixtures\Story;

use App\DataFixtures\Factory\CategoryFactory;
use App\Entity\Category;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\Story;

/**
 * @method static Category|Proxy php()
 * @method static Category|Proxy symfony()
 */
final class CategoryStory extends Story
{
    public function build(): void
    {
        $this->add('php', CategoryFactory::new()->create(['name' => 'php']));
        $this->add('symfony', CategoryFactory::new()->create(['name' => 'symfony']));
    }
}
