<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ClmRaid
 */
class ClmRaid
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $raidTier;

    /**
     * @var arrayCollection
     */
    private $participants;

    /**
     * @var arrayCollection
     */
    private $lootedItems;

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
     * Set date
     *
     * @param DateTime $date
     *
     * @return ClmRaid
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set contentTier
     *
     * @param string $raidTier
     *
     * @return ClmRaid
     */
    public function setRaidTier($raidTier)
    {
        $this->raidTier = $raidTier;

        return $this;
    }

    /**
     * Get contentTier
     *
     * @return string
     */
    public function getRaidTier()
    {
        return $this->raidTier;
    }

    /**
     * Set participants
     *
     * @param arrayCollection $participants
     *
     * @return ClmRaid
     */
    public function setParticipants($participants)
    {
        $this->participants = $participants;

        return $this;
    }

    /**
     * Get participants
     *
     * @return arrayCollection
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * Set lootedItems
     *
     * @param array $lootedItems
     *
     * @return ClmRaid
     */
    public function setLootedItems($lootedItems)
    {
        $this->lootedItems = $lootedItems;

        return $this;
    }

    /**
     * Get lootedItems
     *
     * @return arrayCollection
     */
    public function getLootedItems()
    {
        return $this->lootedItems;
    }
}

