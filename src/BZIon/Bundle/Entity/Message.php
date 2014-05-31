<?php

namespace BZIon\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 */
class Message
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $timestamp;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
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
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * @return Message
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Message
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * @var \BZIon\Bundle\Entity\Discussion
     */
    private $discussion;

    /**
     * @var \BZIon\Bundle\Entity\Player
     */
    private $sender;


    /**
     * Set discussion
     *
     * @param \BZIon\Bundle\Entity\Discussion $discussion
     * @return Message
     */
    public function setDiscussion(\BZIon\Bundle\Entity\Discussion $discussion)
    {
        $this->discussion = $discussion;

        return $this;
    }

    /**
     * Get discussion
     *
     * @return \BZIon\Bundle\Entity\Discussion 
     */
    public function getDiscussion()
    {
        return $this->discussion;
    }

    /**
     * Set sender
     *
     * @param \BZIon\Bundle\Entity\Player $sender
     * @return Message
     */
    public function setSender(\BZIon\Bundle\Entity\Player $sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return \BZIon\Bundle\Entity\Player 
     */
    public function getSender()
    {
        return $this->sender;
    }
}
