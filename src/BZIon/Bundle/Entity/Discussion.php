<?php

namespace BZIon\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Discussion
 */
class Discussion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var \DateTime
     */
    private $lastActivity;

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
     * Set subject
     *
     * @param string $subject
     * @return Discussion
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set lastActivity
     *
     * @param \DateTime $lastActivity
     * @return Discussion
     */
    public function setLastActivity($lastActivity)
    {
        $this->lastActivity = $lastActivity;

        return $this;
    }

    /**
     * Get lastActivity
     *
     * @return \DateTime 
     */
    public function getLastActivity()
    {
        return $this->lastActivity;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Discussion
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $players;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->players = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add players
     *
     * @param \BZIon\Bundle\Entity\Player $players
     * @return Discussion
     */
    public function addPlayer(\BZIon\Bundle\Entity\Player $players)
    {
        $this->players[] = $players;

        return $this;
    }

    /**
     * Remove players
     *
     * @param \BZIon\Bundle\Entity\Player $players
     */
    public function removePlayer(\BZIon\Bundle\Entity\Player $players)
    {
        $this->players->removeElement($players);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlayers()
    {
        return $this->players;
    }
    /**
     * @var \BZIon\Bundle\Entity\Player
     */
    private $creator;


    /**
     * Set creator
     *
     * @param \BZIon\Bundle\Entity\Player $creator
     * @return Discussion
     */
    public function setCreator(\BZIon\Bundle\Entity\Player $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return \BZIon\Bundle\Entity\Player 
     */
    public function getCreator()
    {
        return $this->creator;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $messages;


    /**
     * Add messages
     *
     * @param \BZIon\Bundle\Entity\Player $messages
     * @return Discussion
     */
    public function addMessage(\BZIon\Bundle\Entity\Player $messages)
    {
        $this->messages[] = $messages;

        return $this;
    }

    /**
     * Remove messages
     *
     * @param \BZIon\Bundle\Entity\Player $messages
     */
    public function removeMessage(\BZIon\Bundle\Entity\Player $messages)
    {
        $this->messages->removeElement($messages);
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
}
