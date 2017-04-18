<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Criteria;

/**
* @ORM\Entity(repositoryClass="AppBundle\Repository\StoreRepository")
 * @ORM\Table(name="fs_betrieb")
 */
class Store
{
    const STATUS_NO_CONTACT = 1;
    const STATUS_NEGOTIATING = 2;
    const STATUS_RUNNING = 3;
    const STATUS_DECLINED = 4;
    const STATUS_THIRD_PARTY_COOPERATION = 5;
    const STATUS_CHARITY_NO_WASTE = 6;

    /**
     * @Groups({"storeList", "storeDetail"})
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Groups({"storeList", "storeDetail"})
     * @ORM\Column(type="string", length=5, name="plz")
     */
    private $zip;

    /**
     * @Groups({"storeList", "storeDetail"})
     * @ORM\Column(type="string", length=50, name="stadt")
     */
    private $city;

    /**
     * @Groups({"storeList", "storeDetail"})
     * @ORM\Column(type="string", length=120, name="`name")
     */
    private $name;

    /**
     * @Groups({"storeList", "storeDetail"})
     * @ORM\Column(type="string", length=120, name="str")
     */
    private $street;

    /**
     * @Groups({"storeList", "storeDetail"})
     * @ORM\Column(type="string", length=20, name="hsnr")
     */
    private $streetNumber;

    /**
     * @Groups({"storeDetail"})
     * @ORM\Column(type="text", name="besonderheiten")
     */
    private $notes;

    /**
     * @Groups({"storeDetail"})
     * @ORM\Column(type="text", name="public_info")
     */
    private $notesPublic;

    /**
     * @Groups({"storeDetail"})
     * @ORM\ManyToOne(targetEntity="Conversation", fetch="LAZY")
     * @ORM\JoinColumn(name="team_conversation_id", referencedColumnName="id", nullable=true)
     */
    private $teamConversation;

    /**
     * @Groups({"storeDetail"})
     * @ORM\OneToMany(targetEntity="StoreTeam", mappedBy="store")
     */
    private $team;

    /**
     * Groups({"storeList", "storeDetail"})
     * @ORM\Column(type="integer", name="betrieb_status_id")
     */
    private $status;

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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->team = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add team
     *
     * @param \AppBundle\Entity\StoreTeam $team
     *
     * @return Store
     */
    public function addTeam(\AppBundle\Entity\StoreTeam $team)
    {
        $this->team[] = $team;

        return $this;
    }

    /**
     * Remove team
     *
     * @param \AppBundle\Entity\StoreTeam $team
     */
    public function removeTeam(\AppBundle\Entity\StoreTeam $team)
    {
        $this->team->removeElement($team);
    }

    /**
     * Get team
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeam()
    {
        return $this->team;
    }

    public function isInTeam(\AppBundle\Entity\User $user)
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq("user", $user))
            ->andWhere(Criteria::expr()->gt("status", 0));
        $team = $this->getTeam();
        return count($this->getTeam()->matching($criteria)) > 0;
    }

    /**
     * Set notesPublic
     *
     * @param string $notesPublic
     *
     * @return Store
     */
    public function setNotesPublic($notesPublic)
    {
        $this->notesPublic = $notesPublic;

        return $this;
    }

    /**
     * Get notesPublic
     *
     * @return string
     */
    public function getNotesPublic()
    {
        return $this->notesPublic;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Store
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }
}
