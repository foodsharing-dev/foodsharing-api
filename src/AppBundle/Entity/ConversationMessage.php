<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="fs_msg")
 */
class ConversationMessage
{
    /**
     * @Groups({"conversationDetail"})
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Conversation", fetch="LAZY", inversedBy="messages")
     * @ORM\JoinColumn(name="conversation_id", referencedColumnName="id", nullable=false)
     */
    private $conversation;

    /**
     * @Groups({"conversationDetail"})
     * @ORM\ManyToOne(targetEntity="User", fetch="LAZY")
     * @ORM\JoinColumn(name="foodsaver_id", referencedColumnName="id", nullable=false)
     */
    private $sentBy;

    /**
     * @Groups({"conversationDetail"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $body;

    /**
     * @Groups({"conversationDetail"})
     * @ORM\Column(type="datetime", name="`time``", nullable=true)
     */
    private $sentAt;

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
     * Set body
     *
     * @param string $body
     *
     * @return ConversationMessage
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set sentAt
     *
     * @param \DateTime $sentAt
     *
     * @return ConversationMessage
     */
    public function setSentAt($sentAt)
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    /**
     * Get sentAt
     *
     * @return \DateTime
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }

    /**
     * Set conversation
     *
     * @param \AppBundle\Entity\Conversation $conversation
     *
     * @return ConversationMessage
     */
    public function setConversation(\AppBundle\Entity\Conversation $conversation)
    {
        $this->conversation = $conversation;

        return $this;
    }

    /**
     * Get conversation
     *
     * @return \AppBundle\Entity\Conversation
     */
    public function getConversation()
    {
        return $this->conversation;
    }

    /**
     * Set sentBy
     *
     * @param \AppBundle\Entity\User $sentBy
     *
     * @return ConversationMessage
     */
    public function setSentBy(\AppBundle\Entity\User $sentBy)
    {
        $this->sentBy = $sentBy;

        return $this;
    }

    /**
     * Get sentBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getSentBy()
    {
        return $this->sentBy;
    }
}
