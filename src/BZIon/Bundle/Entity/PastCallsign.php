<?php

namespace BZIon\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PastCallsign
 */
class PastCallsign
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;


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
     * Set username
     *
     * @param string $username
     * @return PastCallsign
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * @var \BZIon\Bundle\Entity\Player
     */
    private $player;


    /**
     * Set player
     *
     * @param \BZIon\Bundle\Entity\Player $player
     * @return PastCallsign
     */
    public function setPlayer(\BZIon\Bundle\Entity\Player $player)
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
