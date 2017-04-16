<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="AppBundle\Repository\StoreRepository")
 * @ORM\Table(name="fs_betrieb")
 */
class Store
{
    /**
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5, name="plz")
     */
    private $zip;

    /**
     * @ORM\Column(type="string", length=50, name="stadt")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=120, name="`name")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=120, name="str")
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=20, name="hsnr")
     */
    private $streetNumber;

    /**
     * @ORM\Column(type="text", name="besonderheiten")
     */
    private $notes;

    /**
     * @ORM\ManyToOne(targetEntity="Conversation", fetch="LAZY")
     * @ORM\JoinColumn(name="team_conversation_id", referencedColumnName="id", nullable=true)
     */
    private $teamConversation;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set zip
     *
     * @param string $zip
     *
     * @return Store
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Store
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Store
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return Store
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set streetNumber
     *
     * @param string $streetNumber
     *
     * @return Store
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    /**
     * Get streetNumber
     *
     * @return string
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return Store
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set teamConversation
     *
     * @param \AppBundle\Entity\Conversation $teamConversation
     *
     * @return Store
     */
    public function setTeamConversation(\AppBundle\Entity\Conversation $teamConversation = null)
    {
        $this->teamConversation = $teamConversation;

        return $this;
    }

    /**
     * Get teamConversation
     *
     * @return \AppBundle\Entity\Conversation
     */
    public function getTeamConversation()
    {
        return $this->teamConversation;
    }
}
