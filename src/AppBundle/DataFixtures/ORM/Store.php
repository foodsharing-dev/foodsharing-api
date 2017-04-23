<?php namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Util\FactoryMuffin;
use AppBundle\Entity\User;

class LoadStoreData implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $group = $manager->getRepository('AppBundle\Entity\Group')->findAll()[0];
        $fetchWeight = $manager->getRepository('AppBundle\Entity\StoreFetchWeight')->findAll()[0];
        FactoryMuffin::seed(10, 'AppBundle\Entity\Store', ['district' => $group, 'averageFetchWeight' => $fetchWeight]);
    }

    public function getOrder()
    {
        return 20;
    }
}
