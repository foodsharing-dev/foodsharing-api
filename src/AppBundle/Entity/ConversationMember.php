<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConversationRepository")
 * @ORM\Table(name="fs_foodsaver_has_conversation")
 */
class ConversationMember
{
    /**
     * @ORM\Column(type="integer", name="foodsaver_id", options={"unsigned":true})
     * @ORM\ManyToOne(targetEntity="User", fetch="EAGER")
     * @ORM\Id
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Conversation", inversedBy="members", fetch="LAZY")
     * @ORM\JoinColumn(name="conversation_id", referencedColumnName="id", nullable=true)
     * @ORM\Id
     */
    private $conversation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $unread;

    /**
     * Set user
     *
     * @param integer $user
     *
     * @return ConversationMember
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set conversation
     *
     * @param integer $conversation
     *
     * @return ConversationMember
     */
    public function setConversation($conversation)
    {
        $this->conversation = $conversation;

        return $this;
    }

    /**
     * Get conversation
     *
     * @return integer
     */
    public function getConversation()
    {
        return $this->conversation;
    }

    /**
     * Set unread
     *
     * @param boolean $unread
     *
     * @return ConversationMember
     */
    public function setUnread($unread)
    {
        $this->unread = $unread;

        return $this;
    }

    /**
     * Get unread
     *
     * @return boolean
     */
    public function getUnread()
    {
        return $this->unread;
    }
}
