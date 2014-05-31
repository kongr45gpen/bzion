<?php

namespace BZIon\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 */
class Role
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
     * @var boolean
     */
    private $reusable;

    /**
     * @var boolean
     */
    private $protected;


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
     * @return Role
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
     * Set reusable
     *
     * @param boolean $reusable
     * @return Role
     */
    public function setReusable($reusable)
    {
        $this->reusable = $reusable;

        return $this;
    }

    /**
     * Get reusable
     *
     * @return boolean 
     */
    public function getReusable()
    {
        return $this->reusable;
    }

    /**
     * Set protected
     *
     * @param boolean $protected
     * @return Role
     */
    public function setProtected($protected)
    {
        $this->protected = $protected;

        return $this;
    }

    /**
     * Get protected
     *
     * @return boolean 
     */
    public function getProtected()
    {
        return $this->protected;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $permissions;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $players;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->permissions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->players = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add permissions
     *
     * @param \BZIon\Bundle\Entity\Permission $permissions
     * @return Role
     */
    public function addPermission(\BZIon\Bundle\Entity\Permission $permissions)
    {
        $this->permissions[] = $permissions;

        return $this;
    }

    /**
     * Remove permissions
     *
     * @param \BZIon\Bundle\Entity\Permission $permissions
     */
    public function removePermission(\BZIon\Bundle\Entity\Permission $permissions)
    {
        $this->permissions->removeElement($permissions);
    }

    /**
     * Get permissions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * Add players
     *
     * @param \BZIon\Bundle\Entity\Player $players
     * @return Role
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
}
