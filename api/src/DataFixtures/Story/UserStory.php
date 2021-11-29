<?php

namespace App\DataFixtures\Story;

use App\DataFixtures\Factory\UserFactory;
use App\Entity\User;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\Story;

/**
 * @method static User|Proxy dev()
 * @method static User|Proxy design()
 */
final class UserStory extends Story
{
    public function build(): void
    {
        $this->add('admin', UserFactory::new()->create(['name' => 'admin']));
        $this->add('random_1', UserFactory::new()->create());
    }
}
