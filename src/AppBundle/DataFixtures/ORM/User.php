<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Util\FactoryMuffin;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        FactoryMuffin::seed(10, 'AppBundle\Entity\User', ['role' => User::ROLE_FOODSAVER]);
    }
}
