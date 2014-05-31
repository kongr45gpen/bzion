<?php

namespace BZIon\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ban
 */
class Ban
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $expiration;

    /**
     * @var string
     */
    private $serverMessage;

    /**
     * @var string
     */
    private $reason;

    /**
     * @var boolean
     */
    private $allowServerJoin;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $updated;


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
     * Set expiration
     *
     * @param \DateTime $expiration
     * @return Ban
     */
    public function setExpiration($expiration)
    {
        $this->expiration = $expiration;

        return $this;
    }

    /**
     * Get expiration
     *
     * @return \DateTime 
     */
    public function getExpiration()
    {
        return $this->expiration;
    }

    /**
     * Set serverMessage
     *
     * @param string $serverMessage
     * @return Ban
     */
    public function setServerMessage($serverMessage)
    {
        $this->serverMessage = $serverMessage;

        return $this;
    }

    /**
     * Get serverMessage
     *
     * @return string 
     */
    public function getServerMessage()
    {
        return $this->serverMessage;
    }

    /**
     * Set reason
     *
     * @param string $reason
     * @return Ban
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string 
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set allowServerJoin
     *
     * @param boolean $allowServerJoin
     * @return Ban
     */
    public function setAllowServerJoin($allowServerJoin)
    {
        $this->allowServerJoin = $allowServerJoin;

        return $this;
    }

    /**
     * Get allowServerJoin
     *
     * @return boolean 
     */
    public function getAllowServerJoin()
    {
        return $this->allowServerJoin;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Ban
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Ban
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ips;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ips = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ips
     *
     * @param \BZIon\Bundle\Entity\BannedIP $ips
     * @return Ban
     */
    public function addIp(\BZIon\Bundle\Entity\BannedIP $ips)
    {
        $this->ips[] = $ips;

        return $this;
    }

    /**
     * Remove ips
     *
     * @param \BZIon\Bundle\Entity\BannedIP $ips
     */
    public function removeIp(\BZIon\Bundle\Entity\BannedIP $ips)
    {
        $this->ips->removeElement($ips);
    }

    /**
     * Get ips
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIps()
    {
        return $this->ips;
    }
    /**
     * @var \BZIon\Bundle\Entity\Player
     */
    private $player;


    /**
     * Set player
     *
     * @param \BZIon\Bundle\Entity\Player $player
     * @return Ban
     */
    public function setPlayer(\BZIon\Bundle\Entity\Player $player = null)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return \BZIon\Bundle\Entity\Player 
     */
    public function getPlayer()
    {
        return $this->player;
    }
}
