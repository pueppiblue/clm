<?php

namespace AppBundle\Entity;

/**
 * Item
 */
class ClmItem
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $looter;

    /**
     * @var \DateTime
     */
    private $dropDate;

    /**
     * @var string
     */
    private $category;

    /**
     * @var bool
     */
    private $isCash;

    /**
     * Item constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ClmItem
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
     * Set user
     *
     * @param integer $looter
     *
     * @return ClmItem
     */
    public function setLooter(ClmAccount $looter)
    {
        $this->looter = $looter;
        $looter->assignItem($this);

        return $this;
    }

    /**
     * Get user
     *
     * @return int
     */
    public function getLooter()
    {
        return $this->looter;
    }

    /**
     * Set dropDate
     *
     * @param \DateTime $dropDate
     *
     * @return ClmItem
     */
    public function setDropDate($dropDate)
    {
        $this->dropDate = $dropDate;

        return $this;
    }

    /**
     * Get dropDate
     *
     * @return \DateTime
     */
    public function getDropDate()
    {
        return $this->dropDate;
    }

    /**
     * Set type
     *
     * @param string $category
     *
     * @return ClmItem
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set isCash
     *
     * @param boolean $isCash
     *
     * @return ClmItem
     */
    public function setIsCash($isCash)
    {
        $this->isCash = $isCash;

        return $this;
    }

    /**
     * Get isCash
     *
     * @return bool
     */
    public function getIsCash()
    {
        return $this->isCash;
    }
}

