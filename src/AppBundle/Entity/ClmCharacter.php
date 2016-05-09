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
    protected $name;
    /**
     * @var string
     */
    protected $clmClass;
    /**
     * @var integer
     */
    protected $account;
    /**
     * @var ArrayCollection
     */
    protected $preferredSet = null;
    /**
     * Character constructor.
     * @param $name
     * @param $class
     * @param $user
     */
    public function __construct($name, ClmAccount $account, $class)
    {
        $this->name = $name;
        $this->clmClass = $class;
        $this->account = $account;
        $account->assignChar($this);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getClmClass()
    {
        return $this->clmClass;
    }

    /**
     * @param ArrayCollection $preferredSet
     */
    public function setPreferredSet($preferredSet)
    {
        $this->preferredSet = $preferredSet;
    }

    /**
     * @return mixed
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
