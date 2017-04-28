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

    const EFT_NONE = 0;
    const EFT_MORNING = 1;
    const EFT_NOON = 2;
    const EFT_EVENING = 3;
    const EFT_NIGHT = 4;

    const CONVICTION_EASY = 1;
    const CONVICTION_MEDIUM = 2;
    const CONVICTION_DIFFICULT = 3;
    const CONVICTION_NEEDED_TIME = 4;

    const TEAM_STATUS_FULL = 0;
    const TEAM_STATUS_OPEN = 1;
    const TEAM_STATUS_IN_NEED = 2;

    /**
     * @Groups({"storeList", "storeDetail"})
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Groups({"storeList", "storeDetail"})
     * @ORM\ManyToOne(targetEntity="Group", fetch="LAZY")
     * @ORM\JoinColumn(name="bezirk_id", referencedColumnName="id", nullable=false)
     */
    private $district;

    /**
     * @Groups({"storeDetail"})
     * @ORM\Column(type="date", name="added")
     */
    private $created_at;

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
     * @ORM\Column(type="text", name="besonderheiten", nullable=true)
     */
    private $notes;

    /**
     * @Groups({"storeDetail"})
     * @ORM\Column(type="text", name="public_info", nullable=true)
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
     * @ORM\ManyToOne(targetEntity="Conversation", fetch="LAZY")
     * @ORM\JoinColumn(name="springer_conversation_id", referencedColumnName="id", nullable=true)
     */
    private $waiterConversation;

    /**
     * @Groups({"storeDetail"})
     * @ORM\OneToMany(targetEntity="StoreTeam", mappedBy="store")
     */
    private $team;

    /**
     * Groups({"storeList", "storeDetail"})
     *
     * @ORM\Column(type="smallint", name="betrieb_status_id")
     */
    private $status = self::STATUS_NO_CONTACT;

    /**
     * @ORM\Column(type="smallint", name="public_time")
     */
    private $estimatedFetchTime = self::EFT_NONE;

    /**
     * @ORM\Column(type="smallint", name="ueberzeugungsarbeit")
     */
    private $conviction = self::CONVICTION_EASY;

    /**
     * describes if the store cooperation might be used in communication towards press
     *
     * @ORM\Column(type="boolean", name="presse")
     */
    private $nameInPressOk = false;

    /**
     * describes if the store would like to have foodsharing stickers in the shop
     *
     * @ORM\Column(type="boolean", name="sticker")
     */
    private $putStickerOk = false;

    /**
     * @ORM\ManyToOne(targetEntity="StoreFetchWeight", fetch="EAGER")
     * @ORM\JoinColumn(name="abholmenge", referencedColumnName="id", nullable=false)
     */
    private $averageFetchWeight;

    /**
     * @ORM\Column(type="smallint", name="team_status")
     */
    private $teamStatus = self::TEAM_STATUS_FULL;

    /**
     * @ORM\Column(type="integer", options={"unsigned": true}, name="prefetchtime")
     */
    private $pickupSignupAdvance = 1209600;

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
        $this->created_at = new \DateTime();
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
            ->where(Criteria::expr()->eq('user', $user))
            ->andWhere(Criteria::expr()->gt('status', 0));
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
     * @param int $status
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
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Store
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set estimatedFetchTime
     *
     * @param int $estimatedFetchTime
     *
     * @return Store
     */
    public function setEstimatedFetchTime($estimatedFetchTime)
    {
        $this->estimatedFetchTime = $estimatedFetchTime;

        return $this;
    }

    /**
     * Get estimatedFetchTime
     *
     * @return int
     */
    public function getEstimatedFetchTime()
    {
        return $this->estimatedFetchTime;
    }

    /**
     * Set conviction
     *
     * @param int $conviction
     *
     * @return Store
     */
    public function setConviction($conviction)
    {
        $this->conviction = $conviction;

        return $this;
    }

    /**
     * Get conviction
     *
     * @return int
     */
    public function getConviction()
    {
        return $this->conviction;
    }

    /**
     * Set nameInPressOk
     *
     * @param bool $nameInPressOk
     *
     * @return Store
     */
    public function setNameInPressOk($nameInPressOk)
    {
        $this->nameInPressOk = $nameInPressOk;

        return $this;
    }

    /**
     * Get nameInPressOk
     *
     * @return bool
     */
    public function getNameInPressOk()
    {
        return $this->nameInPressOk;
    }

    /**
     * Set putStickerOk
     *
     * @param bool $putStickerOk
     *
     * @return Store
     */
    public function setPutStickerOk($putStickerOk)
    {
        $this->putStickerOk = $putStickerOk;

        return $this;
    }

    /**
     * Get putStickerOk
     *
     * @return bool
     */
    public function getPutStickerOk()
    {
        return $this->putStickerOk;
    }

    /**
     * Set district
     *
     * @param \AppBundle\Entity\Group $district
     *
     * @return Store
     */
    public function setDistrict(\AppBundle\Entity\Group $district = null)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return \AppBundle\Entity\Group
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set averageFetchWeight
     *
     * @param \AppBundle\Entity\StoreFetchWeight $averageFetchWeight
     *
     * @return Store
     */
    public function setAverageFetchWeight(\AppBundle\Entity\StoreFetchWeight $averageFetchWeight)
    {
        $this->averageFetchWeight = $averageFetchWeight;

        return $this;
    }

    /**
     * Get averageFetchWeight
     *
     * @return \AppBundle\Entity\StoreFetchWeight
     */
    public function getAverageFetchWeight()
    {
        return $this->averageFetchWeight;
    }

    /**
     * Set teamStatus
     *
     * @param int $teamStatus
     *
     * @return Store
     */
    public function setTeamStatus($teamStatus)
    {
        $this->teamStatus = $teamStatus;

        return $this;
    }

    /**
     * Get teamStatus
     *
     * @return int
     */
    public function getTeamStatus()
    {
        return $this->teamStatus;
    }

    /**
     * Set pickupSignupAdvance
     *
     * @param int $pickupSignupAdvance
     *
     * @return Store
     */
    public function setPickupSignupAdvance($pickupSignupAdvance)
    {
        $this->pickupSignupAdvance = $pickupSignupAdvance;

        return $this;
    }

    /**
     * Get pickupSignupAdvance
     *
     * @return int
     */
    public function getPickupSignupAdvance()
    {
        return $this->pickupSignupAdvance;
    }

    /**
     * Set waiterConversation
     *
     * @param \AppBundle\Entity\Conversation $waiterConversation
     *
     * @return Store
     */
    public function setWaiterConversation(\AppBundle\Entity\Conversation $waiterConversation = null)
    {
        $this->waiterConversation = $waiterConversation;

        return $this;
    }

    /**
     * Get waiterConversation
     *
     * @return \AppBundle\Entity\Conversation
     */
    public function getWaiterConversation()
    {
        return $this->waiterConversation;
    }
}
