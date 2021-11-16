<?php

namespace App\Story;

use App\Entity\Category;
use App\Factory\CategoryFactory;
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
