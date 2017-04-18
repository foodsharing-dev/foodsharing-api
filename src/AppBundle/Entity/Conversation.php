<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConversationRepository")
 * @ORM\Table(name="fs_conversation")
 */
class Conversation
{
    /**
     * @Groups({"conversationList", "conversationDetail"})
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $locked;

    /**
     * @Groups({"conversationList", "conversationDetail"})
     * @ORM\Column(type="string", length=40, name="`name`")
     */
    private $name;

    /**
     * @ORM\Column(type="datetime", name="start", nullable=true)
     */
    private $firstMessageAt;

    /**
     * @Groups({"conversationList"})
     * @ORM\Column(type="datetime", name="last", nullable=true)
     */
    private $lastMessageAt;

    /**
     * @ORM\ManyToOne(targetEntity="User", fetch="LAZY")
     * @ORM\JoinColumn(name="last_foodsaver_id", referencedColumnName="id")
     */
    private $lastUser;

    /**
     * @ORM\ManyToOne(targetEntity="User", fetch="LAZY")
     * @ORM\JoinColumn(name="start_foodsaver_id", referencedColumnName="id")
     */
    private $firstUser;

    /**
     * Intentionally not use denormalized field here for now as long as it does not become a problem.
     *
     * @Groups({"conversationList"})
     * @ORM\ManyToOne(targetEntity="ConversationMessage", fetch="EAGER")
     * @ORM\JoinColumn(name="last_message_id", referencedColumnName="id")
     */
    private $lastMessage;

    /**
     * @Groups({"conversationList", "conversationDetail"})
     * @ORM\OneToMany(targetEntity="ConversationMember", mappedBy="conversation", fetch="EAGER")
     */
    private $members;

    /**
     * @Groups({"conversationDetail"})
     * @ORM\OneToMany(targetEntity="ConversationMessage", mappedBy="conversation")
     */
    private $messages;


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
     * Set locked
     *
     * @param boolean $locked
     *
     * @return Conversation
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * Get locked
     *
     * @return boolean
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Conversation
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
     * Set firstMessageAt
     *
     * @param \DateTime $firstMessageAt
     *
     * @return Conversation
     */
    public function setFirstMessageAt($firstMessageAt)
    {
        $this->firstMessageAt = $firstMessageAt;

        return $this;
    }

    /**
     * Get firstMessageAt
     *
     * @return \DateTime
     */
    public function getFirstMessageAt()
    {
        return $this->firstMessageAt;
    }

    /**
     * Set lastMessageAt
     *
     * @param \DateTime $lastMessageAt
     *
     * @return Conversation
     */
    public function setLastMessageAt($lastMessageAt)
    {
        $this->lastMessageAt = $lastMessageAt;

        return $this;
    }

    /**
     * Get lastMessageAt
     *
     * @return \DateTime
     */
    public function getLastMessageAt()
    {
        return $this->lastMessageAt;
    }

    /**
     * Set lastUser
     *
     * @param \AppBundle\Entity\User $lastUser
     *
     * @return Conversation
     */
    public function setLastUser(\AppBundle\Entity\User $lastUser = null)
    {
        $this->lastUser = $lastUser;

        return $this;
    }

    /**
     * Get lastUser
     *
     * @return \AppBundle\Entity\User
     */
    public function getLastUser()
    {
        return $this->lastUser;
    }

    /**
     * Set firstUser
     *
     * @param \AppBundle\Entity\User $firstUser
     *
     * @return Conversation
     */
    public function setFirstUser(\AppBundle\Entity\User $firstUser = null)
    {
        $this->firstUser = $firstUser;

        return $this;
    }

    /**
     * Get firstUser
     *
     * @return \AppBundle\Entity\User
     */
    public function getFirstUser()
    {
        return $this->firstUser;
    }

    /**
     * Set lastMessage
     *
     * @param \AppBundle\Entity\ConversationMessage $lastMessage
     *
     * @return Conversation
     */
    public function setLastMessage(\AppBundle\Entity\ConversationMessage $lastMessage = null)
    {
        $this->lastMessage = $lastMessage;

        return $this;
    }

    /**
     * Get lastMessage
     *
     * @return \AppBundle\Entity\ConversationMessage
     */
    public function getLastMessage()
    {
        return $this->lastMessage;
    }

    /**
     * Add message
     *
     * @param \AppBundle\Entity\ConversationMessage $message
     *
     * @return Conversation
     */
    public function addMessage(\AppBundle\Entity\ConversationMessage $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \AppBundle\Entity\ConversationMessage $message
     */
    public function removeMessage(\AppBundle\Entity\ConversationMessage $message)
    {
        $this->messages->removeElement($message);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    public function isMember(\AppBundle\Entity\User $user = null)
    {
        return $this->members->exists(function($key, $elem) use ($user) {return $elem->getUser()->getId() === $user->getId();});
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->members = new \Doctrine\Common\Collections\ArrayCollection();
        $this->messages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add member
     *
     * @param \AppBundle\Entity\ConversationMember $member
     *
     * @return Conversation
     */
    public function addMember(\AppBundle\Entity\ConversationMember $member)
    {
        $this->members[] = $member;

        return $this;
    }

    /**
     * Remove member
     *
     * @param \AppBundle\Entity\ConversationMember $member
     */
    public function removeMember(\AppBundle\Entity\ConversationMember $member)
    {
        $this->members->removeElement($member);
    }

    /**
     * Get members
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMembers()
    {
        return $this->members;
    }
}
