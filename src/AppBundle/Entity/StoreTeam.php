<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StoreTeamRepository")
 * @ORM\Table(name="fs_betrieb_team")
 */
class StoreTeam
{
    const STATUS_REQUESTED = 0;
    const STATUS_TEAM = 1;
    /* The queue (Warteliste, Springerliste) is very unclear as well as in code and in what people do with it.
       Better try not to use it. People in it have a limited view on the store in legacy page. */
    const STATUS_QUEUE = 2;
    /**
     * @Groups({"storeDetail"})
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User", fetch="EAGER")
     * @ORM\JoinColumn(name="foodsaver_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Store", inversedBy="team", fetch="LAZY")
     * @ORM\JoinColumn(name="betrieb_id", referencedColumnName="id", nullable=false)
     */
    private $store;

    /**
     * @Groups({"storeDetail"})
     * @ORM\Column(type="boolean", name="verantwortlich")
     */
    private $coordinator;

    /**
     * @Groups({"storeDetail"})
     * @ORM\Column(type="integer", name="active")
     */
    private $status = 0;

    /**
     * Set coordinator
     *
     * @param bool $coordinator
     *
     * @return StoreTeam
     */
    public function setCoordinator($coordinator)
    {
        $this->coordinator = $coordinator;

        return $this;
    }

    /**
     * Get coordinator
     *
     * @return bool
     */
    public function getCoordinator()
    {
        return $this->coordinator;
    }

    /**
     * Set status
     *
     * @param int $status
     *
     * @return StoreTeam
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return StoreTeam
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set store
     *
     * @param \AppBundle\Entity\Store $store
     *
     * @return StoreTeam
     */
    public function setStore(\AppBundle\Entity\Store $store)
    {
        $this->store = $store;

        return $this;
    }

    /**
     * Get store
     *
     * @return \AppBundle\Entity\Store
     */
    public function getStore()
    {
        return $this->store;
    }
}
