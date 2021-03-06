<?php

namespace AppBundle\Repository;

use Doctrine\ORM\Query;

/**
 * TakenPickupRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TakenPickupRepository extends \Doctrine\ORM\EntityRepository
{
    public function findNextForUserOrderedByDate($userId)
    {
        return $this->getEntityManager()
        ->createQueryBuilder()
        ->select('p')
        ->from('AppBundle:TakenPickup', 'p')
        ->where(':user_id = p.user')
        ->andWhere('p.at > :min_date')
        ->orderBy('p.at', 'ASC')
        ->setParameter('user_id', $userId)
        ->setParameter('min_date', new \DateTime('-1 hour'))
        ->getQuery()
        ->getResult();
    }

    public function getPickupDetails($storeId, $at)
    {
        //$pickup = $this->findBy(['store' => $storeId, 'at' => $at]);
        $pickup = $this->getEntityManager()->createQueryBuilder()
        ->select('p')
        ->from('AppBundle:TakenPickup', 'p')
        ->where(':store_id = p.store')
        ->andWhere(':at = p.at')
        ->setParameter('store_id', $storeId)
        ->setParameter('at', $at)
        ->getQuery()
        ->getResult();

        $members = array();
        foreach($pickup as $p) {
            $members[] = array('user' => $p->getUser(), 'confirmed' => $p->getConfirmed());
        }
        $result = array('store' => $pickup[0]->getStore(), 'at' => $pickup[0]->getAt(), 'members' => $members);

        return $result;
    }
}
