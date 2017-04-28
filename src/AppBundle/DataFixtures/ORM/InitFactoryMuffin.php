<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Util\FactoryMuffin;

class InitFactoryMuffin implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        FactoryMuffin::init($manager);
    }

    public function getOrder()
    {
        return 0;
    }
}
