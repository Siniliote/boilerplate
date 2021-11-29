<?php

namespace App\DataFixtures;

use App\DataFixtures\Story\PostStory;
use App\DataFixtures\Story\UserStory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager): void
    {
        UserStory::load();
        PostStory::load();
    }
}
