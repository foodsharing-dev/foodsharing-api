<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Util\FactoryMuffin;

class LoadGroupData implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        FactoryMuffin::seed(10, 'AppBundle\Entity\Group');
    }

    public function getOrder()
    {
        return 10;
    }
}
