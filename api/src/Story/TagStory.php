<?php

namespace App\Story;

use App\Factory\TagFactory;
use Zenstruck\Foundry\Story;

final class TagStory extends Story
{
    public function build(): void
    {
        $this->add('dev', TagFactory::new()->create(['name' => 'dev']));
        $this->add('design', TagFactory::new()->create(['name' => 'design']));
    }
}
