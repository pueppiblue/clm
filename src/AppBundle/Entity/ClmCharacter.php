<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/*
 * @Entity Character
 */
class ClmCharacter
{
    /**
     * @var
     */
    protected $id;

    /**
     * @var string
     */
    protected $charName;
    /**
     * @var string
     */
    protected $clmClass;

    /**
     * @var clmAccount
     */
    protected $account;

    /**
     * @var ArrayCollection
     */
    protected $preferredSet = null;

    /**
     * ClmCharacter constructor.
     * @param $name
     * @param $clmClass
     */
    public function __construct($name = '', $clmClass = '')
    {
        $this->charName = $name;
        $this->clmClass = $clmClass;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->charName;
    }

    /**
     * @param $charName
     * @return $this
     */
    public function setCharName($charName)
    {
        $this->charName = $charName;
        return $this;
    }

    /**
     * @param string $clmClass
     * @return $this
     */
    public function setClmClass($clmClass)
    {
        $this->clmClass = $clmClass;
        return $this;
    }

    /**
     * @param $account
     * @return $this
     */
    public function setAccount(ClmAccount $account)
    {
        $this->account = $account;
        $account->assignChar($this);
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCharName()
    {
        return $this->charName;
    }

    /**
     * @return string
     */
    public function getClmClass()
    {
        return $this->clmClass;
    }

    /**
     * @param string $preferredSet
     * @return ClmCharacter
     */
    public function setPreferredSet($preferredSet)
    {
        $this->preferredSet = $preferredSet;
        return $this;
    }

    /**
     * @return ClmAccount
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @return ArrayCollection
     */
    public function getPreferredSet()
    {
        return $this->preferredSet;
    }


}
