<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\ClmAccount;
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
    protected $name;
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
     * Character constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }


    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param $clmClass
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
    public function getName()
    {
        return $this->name;
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
