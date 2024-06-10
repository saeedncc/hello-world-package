<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Factory\TaskFactory;

class TaskFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
		TaskFactory::createMany(50);
		
    }
}
