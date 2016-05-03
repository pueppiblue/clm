<?php
/**
 * Created by PhpStorm.
 * User: pueppi
 * Date: 03.05.16
 * Time: 17:09
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;

/*
 * @Entity User
 */
class User
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $name;
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
    protected $urn=0;
    /**
     * @var int
     */
    protected $weapon=0;
    /**
     * @var ArrayCollection
     */
    protected $items;

    /**
     * @var ArrayCollection
     */
    protected $characters;

    /**
     * User constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->items = new ArrayCollection();
        $this->characters= new ArrayCollection();
    }

    /**
     * @param $item
     */
    public function assignItem($item)
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

    /**
     * @param $char
     */
    public function assignChar($char) {
        $this->characters[] = $char;
    }
}