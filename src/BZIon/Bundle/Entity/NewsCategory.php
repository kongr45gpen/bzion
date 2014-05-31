<?php

namespace BZIon\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsCategory
 */
class NewsCategory
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $alias;

    /**
     * @var string
     */
    private $name;

    /**
     * @var boolean
     */
    private $protected;

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
     * Set alias
     *
     * @param string $alias
     * @return NewsCategory
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
     * Set name
     *
     * @param string $name
     * @return NewsCategory
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
     * Set protected
     *
     * @param boolean $protected
     * @return NewsCategory
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
     * Set status
     *
     * @param string $status
     * @return NewsCategory
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
    private $targetEntity;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $mappedBy;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->targetEntity = new \Doctrine\Common\Collections\ArrayCollection();
        $this->mappedBy = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add targetEntity
     *
     * @param \BZIon\Bundle\Entity\N $targetEntity
     * @return NewsCategory
     */
    public function addTargetEntity(\BZIon\Bundle\Entity\N $targetEntity)
    {
        $this->targetEntity[] = $targetEntity;

        return $this;
    }

    /**
     * Remove targetEntity
     *
     * @param \BZIon\Bundle\Entity\N $targetEntity
     */
    public function removeTargetEntity(\BZIon\Bundle\Entity\N $targetEntity)
    {
        $this->targetEntity->removeElement($targetEntity);
    }

    /**
     * Get targetEntity
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTargetEntity()
    {
        return $this->targetEntity;
    }

    /**
     * Add mappedBy
     *
     * @param \BZIon\Bundle\Entity\c $mappedBy
     * @return NewsCategory
     */
    public function addMappedBy(\BZIon\Bundle\Entity\c $mappedBy)
    {
        $this->mappedBy[] = $mappedBy;

        return $this;
    }

    /**
     * Remove mappedBy
     *
     * @param \BZIon\Bundle\Entity\c $mappedBy
     */
    public function removeMappedBy(\BZIon\Bundle\Entity\c $mappedBy)
    {
        $this->mappedBy->removeElement($mappedBy);
    }

    /**
     * Get mappedBy
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMappedBy()
    {
        return $this->mappedBy;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $articles;


    /**
     * Add articles
     *
     * @param \BZIon\Bundle\Entity\NewsArticle $articles
     * @return NewsCategory
     */
    public function addArticle(\BZIon\Bundle\Entity\NewsArticle $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param \BZIon\Bundle\Entity\NewsArticle $articles
     */
    public function removeArticle(\BZIon\Bundle\Entity\NewsArticle $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }
}
