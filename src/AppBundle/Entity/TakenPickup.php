<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TakenPickupRepository")
 * @ORM\Table(name="fs_abholer")
 */
class TakenPickup
{
    /**
     * @Groups({"pickupDetail"})
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User", fetch="LAZY")
     * @ORM\JoinColumn(name="foodsaver_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @Groups({"pickupDetail"})
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Store", fetch="LAZY")
     * @ORM\JoinColumn(name="betrieb_id", referencedColumnName="id", nullable=false)
     */
    private $store;

    /**
     * @Groups({"pickupDetail"})
     * @ORM\Id
     * @ORM\Column(type="datetimekey", name="`date``", nullable=false)
     */
    private $at;

    /**
     * @Groups({"pickupDetail"})
     * @ORM\Column(type="boolean")
     */
    private $confirmed;

    /**
     * Set at
     *
     * @param \DateTime $at
     *
     * @return TakenPickup
     */
    public function setAt($at)
    {
        $this->at = $at;

        return $this;
    }

    /**
     * Get at
     *
     * @return \DateTime
     */
    public function getAt()
    {
        return $this->at;
    }

    /**
     * Set confirmed
     *
     * @param boolean $confirmed
     *
     * @return TakenPickup
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    /**
     * Get confirmed
     *
     * @return boolean
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return TakenPickup
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
     * @return TakenPickup
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
