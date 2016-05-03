<?php

namespace AppBundle\Entity;

/**
 * Item
 */
class Item
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
     * @return Item
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
     * @return Item
     */
    public function setLooter($looter)
    {
        $this->looter = $looter;

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
     * @return Item
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
     * @return Item
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
     * @return Item
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

