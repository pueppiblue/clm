<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;


class ClmAccount
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $accountName;
    /**
     * @var int
     */
    protected $tear=0;
    /**
     * @var int
     */
    protected $acc=0;
    /**
     * @var int
     */
    protected $item=0;

    /**
     * @var int
     */
    protected $urn=0;
    /**
     * @var int
     */
    protected $weapon=0;
    /**
     * @var ArrayCollection
     */
    protected $items = null;

    /**
     * @var ArrayCollection
     */
    protected $characters = null;

    /**
     * User constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->accountName = $name;
        $this->items = new ArrayCollection();
        $this->characters= new ArrayCollection();
    }

    /**
     * @param ArrayCollection $characters
     * @return ClmAccount
     */
    public function setCharacters(ArrayCollection $characters)
    {
        $this->characters = $characters;
            
        return $this;
    }

    /**
     * @param int $tear
     * @return ClmAccount
     */
    public function setTear($tear)
    {
        $this->tear = $tear;

        return $this;
    }

    /**
     * @param int $acc
     * @return ClmAccount
     */
    public function setAcc($acc)
    {
        $this->acc = $acc;

        return $this;
    }

    /**
     * @param int $item
     * @return ClmAccount
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * @param int $urn
     * @return ClmAccount
     */
    public function setUrn($urn)
    {
        $this->urn = $urn;

        return $this;
    }

    /**
     * @param int $weapon
     * @return ClmAccount
     */
    public function setWeapon($weapon)
    {
        $this->weapon = $weapon;

        return $this;
    }

    /**
     * @param $item
     */
    public function assignItem(ClmItem $item)
    {
        $this->items[] = $item;

        switch ($item->getCategory()) {
            case "weapon":
                $this->weapon=0;
                break;
            case "tear":
                $this->tear=0;
                break;
            case "acc":
                $this->acc=0;
                break;
            case "item":
                $this->item=0;
                break;
            case "urn":
                $this->urn=0;
        }
    }

    /**
     * @return int
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param $char
     */
    public function assignChar($char) {
        $this->characters[] = $char;
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
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * @return int
     */
    public function getTear()
    {
        return $this->tear;
    }

    /**
     * @return int
     */
    public function getAcc()
    {
        return $this->acc;
    }

    /**
     * @return int
     */
    public function getUrn()
    {
        return $this->urn;
    }

    /**
     * @return int
     */
    public function getWeapon()
    {
        return $this->weapon;
    }

    /**
     * @return ArrayCollection
     */
    public function getCharacters()
    {
        return $this->characters;
    }

    /**
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }
}
