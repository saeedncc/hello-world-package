<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Factory\TruckFactory;

class TruckFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
		TruckFactory::createMany(10);
		
    }
}
