<?php namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\StoreFetchWeight;

class LoadStoreFetchWeightData implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $weights = ["1.5", "2.0", "4.0", "7.5", "15.0", "25.0", "45.0", "64.0"];
        foreach($weights as $i => $weight)
        {
            $entity = new StoreFetchWeight();
            $entity->setId($i); 
            $entity->setAverageWeight($weight);
            $manager->persist($entity);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
