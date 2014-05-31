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
}
