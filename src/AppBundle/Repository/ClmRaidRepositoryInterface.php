<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ClmRaid;

interface ClmRaidRepositoryInterface
{
    /**
     * @param ClmRaid $raid
     */
    public function save(ClmRaid $raid);

    /**
     * @return ClmRaid[]
     */
    public function findAll();

    /**
     * @param int $id
     * @return ClmRaid
     */
    public function findById($id);

}
