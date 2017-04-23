<?php namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Util\FactoryMuffin;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        FactoryMuffin::create('AppBundle\Entity\User');
    }
}
