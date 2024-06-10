<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Factory\DriverFactory;

class DriverFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
		DriverFactory::createMany(10);
		
    }
}
