<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ClmItem;

interface ClmItemRepositoryInterface
{

    /**
     * @param ClmItem $item
     */
    public function save(ClmItem $item);

    /**
     * @return ClmItem[]
     */
    public function findAll();

    /**
     * @param $name
     * @return ClmItem[]
     */
    public function findByName($name);
}
