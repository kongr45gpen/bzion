<?php

namespace BZIon\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invitation
 */
class Invitation
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
    private $text;


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
     * @return Invitation
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
     * Set text
     *
     * @param string $text
     * @return Invitation
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }
    /**
     * @var \BZIon\Bundle\Entity\Player
     */
    private $invitedPlayer;

    /**
     * @var \BZIon\Bundle\Entity\Player
     */
    private $invitingPlayer;

    /**
     * @var \BZIon\Bundle\Entity\Team
     */
    private $team;


    /**
     * Set invitedPlayer
     *
     * @param \BZIon\Bundle\Entity\Player $invitedPlayer
     * @return Invitation
     */
    public function setInvitedPlayer(\BZIon\Bundle\Entity\Player $invitedPlayer)
    {
        $this->invitedPlayer = $invitedPlayer;

        return $this;
    }

    /**
     * Get invitedPlayer
     *
     * @return \BZIon\Bundle\Entity\Player 
     */
    public function getInvitedPlayer()
    {
        return $this->invitedPlayer;
    }

    /**
     * Set invitingPlayer
     *
     * @param \BZIon\Bundle\Entity\Player $invitingPlayer
     * @return Invitation
     */
    public function setInvitingPlayer(\BZIon\Bundle\Entity\Player $invitingPlayer)
    {
        $this->invitingPlayer = $invitingPlayer;

        return $this;
    }

    /**
     * Get invitingPlayer
     *
     * @return \BZIon\Bundle\Entity\Player 
     */
    public function getInvitingPlayer()
    {
        return $this->invitingPlayer;
    }

    /**
     * Set team
     *
     * @param \BZIon\Bundle\Entity\Team $team
     * @return Invitation
     */
    public function setTeam(\BZIon\Bundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \BZIon\Bundle\Entity\Team 
     */
    public function getTeam()
    {
        return $this->team;
    }
}
