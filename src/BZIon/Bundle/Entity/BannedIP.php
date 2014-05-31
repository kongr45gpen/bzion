<?php

namespace BZIon\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BannedIP
 */
class BannedIP
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $ipAddress;


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
     * Set ipAddress
     *
     * @param string $ipAddress
     * @return BannedIP
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return string 
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }
    /**
     * @var \BZIon\Bundle\Entity\Ban
     */
    private $ban;


    /**
     * Set ban
     *
     * @param \BZIon\Bundle\Entity\Ban $ban
     * @return BannedIP
     */
    public function setBan(\BZIon\Bundle\Entity\Ban $ban = null)
    {
        $this->ban = $ban;

        return $this;
    }

    /**
     * Get ban
     *
     * @return \BZIon\Bundle\Entity\Ban 
     */
    public function getBan()
    {
        return $this->ban;
    }
}
