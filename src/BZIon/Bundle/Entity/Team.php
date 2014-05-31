<?php

namespace BZIon\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 */
class Team
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $alias;

    /**
     * @var string
     */
    private $descriptionMd;

    /**
     * @var string
     */
    private $descriptionHtml;

    /**
     * @var string
     */
    private $avatar;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var integer
     */
    private $elo;

    /**
     * @var float
     */
    private $activity;

    /**
     * @var integer
     */
    private $matchesWon;

    /**
     * @var integer
     */
    private $matchesLost;

    /**
     * @var integer
     */
    private $matchesDraw;

    /**
     * @var integer
     */
    private $memberCount;

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
     * Set name
     *
     * @param string $name
     * @return Team
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
     * Set alias
     *
     * @param string $alias
     * @return Team
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string 
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set descriptionMd
     *
     * @param string $descriptionMd
     * @return Team
     */
    public function setDescriptionMd($descriptionMd)
    {
        $this->descriptionMd = $descriptionMd;

        return $this;
    }

    /**
     * Get descriptionMd
     *
     * @return string 
     */
    public function getDescriptionMd()
    {
        return $this->descriptionMd;
    }

    /**
     * Set descriptionHtml
     *
     * @param string $descriptionHtml
     * @return Team
     */
    public function setDescriptionHtml($descriptionHtml)
    {
        $this->descriptionHtml = $descriptionHtml;

        return $this;
    }

    /**
     * Get descriptionHtml
     *
     * @return string 
     */
    public function getDescriptionHtml()
    {
        return $this->descriptionHtml;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return Team
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Team
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
     * Set elo
     *
     * @param integer $elo
     * @return Team
     */
    public function setElo($elo)
    {
        $this->elo = $elo;

        return $this;
    }

    /**
     * Get elo
     *
     * @return integer 
     */
    public function getElo()
    {
        return $this->elo;
    }

    /**
     * Set activity
     *
     * @param float $activity
     * @return Team
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return float 
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set matchesWon
     *
     * @param integer $matchesWon
     * @return Team
     */
    public function setMatchesWon($matchesWon)
    {
        $this->matchesWon = $matchesWon;

        return $this;
    }

    /**
     * Get matchesWon
     *
     * @return integer 
     */
    public function getMatchesWon()
    {
        return $this->matchesWon;
    }

    /**
     * Set matchesLost
     *
     * @param integer $matchesLost
     * @return Team
     */
    public function setMatchesLost($matchesLost)
    {
        $this->matchesLost = $matchesLost;

        return $this;
    }

    /**
     * Get matchesLost
     *
     * @return integer 
     */
    public function getMatchesLost()
    {
        return $this->matchesLost;
    }

    /**
     * Set matchesDraw
     *
     * @param integer $matchesDraw
     * @return Team
     */
    public function setMatchesDraw($matchesDraw)
    {
        $this->matchesDraw = $matchesDraw;

        return $this;
    }

    /**
     * Get matchesDraw
     *
     * @return integer 
     */
    public function getMatchesDraw()
    {
        return $this->matchesDraw;
    }

    /**
     * Set memberCount
     *
     * @param integer $memberCount
     * @return Team
     */
    public function setMemberCount($memberCount)
    {
        $this->memberCount = $memberCount;

        return $this;
    }

    /**
     * Get memberCount
     *
     * @return integer 
     */
    public function getMemberCount()
    {
        return $this->memberCount;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Team
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
}
