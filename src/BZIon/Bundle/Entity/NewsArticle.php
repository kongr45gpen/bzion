<?php

namespace BZIon\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsArticle
 */
class NewsArticle
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
     * @var string
     */
    private $content;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $updated;

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
     * @return NewsArticle
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
     * Set content
     *
     * @param string $content
     * @return NewsArticle
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return NewsArticle
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
     * @return NewsArticle
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
     * Set status
     *
     * @param string $status
     * @return NewsArticle
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
    private $children;

    /**
     * @var \BZIon\Bundle\Entity\NewsCategory
     */
    private $category;

    /**
     * @var \BZIon\Bundle\Entity\NewsArticle
     */
    private $parent;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add children
     *
     * @param \BZIon\Bundle\Entity\NewsArticle $children
     * @return NewsArticle
     */
    public function addChild(\BZIon\Bundle\Entity\NewsArticle $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \BZIon\Bundle\Entity\NewsArticle $children
     */
    public function removeChild(\BZIon\Bundle\Entity\NewsArticle $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set category
     *
     * @param \BZIon\Bundle\Entity\NewsCategory $category
     * @return NewsArticle
     */
    public function setCategory(\BZIon\Bundle\Entity\NewsCategory $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \BZIon\Bundle\Entity\NewsCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set parent
     *
     * @param \BZIon\Bundle\Entity\NewsArticle $parent
     * @return NewsArticle
     */
    public function setParent(\BZIon\Bundle\Entity\NewsArticle $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \BZIon\Bundle\Entity\NewsArticle 
     */
    public function getParent()
    {
        return $this->parent;
    }
    /**
     * @var \BZIon\Bundle\Entity\Player
     */
    private $author;

    /**
     * @var \BZIon\Bundle\Entity\Player
     */
    private $editor;


    /**
     * Set author
     *
     * @param \BZIon\Bundle\Entity\Player $author
     * @return NewsArticle
     */
    public function setAuthor(\BZIon\Bundle\Entity\Player $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \BZIon\Bundle\Entity\Player 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set editor
     *
     * @param \BZIon\Bundle\Entity\Player $editor
     * @return NewsArticle
     */
    public function setEditor(\BZIon\Bundle\Entity\Player $editor = null)
    {
        $this->editor = $editor;

        return $this;
    }

    /**
     * Get editor
     *
     * @return \BZIon\Bundle\Entity\Player 
     */
    public function getEditor()
    {
        return $this->editor;
    }
}
