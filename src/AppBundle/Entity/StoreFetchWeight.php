<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="fs_abholmengen")
 */
class StoreFetchWeight
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=1, name="menge")
     */
    private $averageWeight;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set averageWeight
     *
     * @param string $averageWeight
     *
     * @return StoreFetchWeight
     */
    public function setAverageWeight($averageWeight)
    {
        $this->averageWeight = $averageWeight;

        return $this;
    }

    /**
     * Get averageWeight
     *
     * @return string
     */
    public function getAverageWeight()
    {
        return $this->averageWeight;
    }

    /**
     * Set id
     *
     * @param int $id
     *
     * @return StoreFetchWeight
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
