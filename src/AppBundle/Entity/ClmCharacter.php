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
    protected $attendedRaids = null;

    /**
     * @var string
     */
    protected $preferredSet = null;


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->charName;
    }

    /**
     * @param ClmItem $item
     */
    public function assignItem(ClmItem $item)
    {
        $this->account->assignItem($item);
    }

    /**
     * @param ClmRaid $raid
     */
    public function assignToRaid(ClmRaid $raid)
    {
        $this->attendedRaids[] = $raid;
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
     * @return string
     */
    public function getPreferredSet()
    {
        return $this->preferredSet;
    }

    /**
     * @return ArrayCollection
     */
    public function getAttendedRaids()
    {
        return $this->attendedRaids;
    }

    /**
     * @param ArrayCollection $attendedRaids
     */
    public function setAttendedRaids($attendedRaids)
    {
        $this->attendedRaids = $attendedRaids;
    }


}
