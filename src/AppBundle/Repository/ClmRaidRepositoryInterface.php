<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ClmRaid;

/**
 * Interface ClmRaidRepositoryInterface
 * @package AppBundle\Repository
 */
interface ClmRaidRepositoryInterface
{
    /**
     * @param ClmRaid $raid
     *
     */
    public function save(ClmRaid $raid);

    /**
     * @return ClmRaid[]
     */
    public function findAll();

    /**
     * @param int $id
     */
    public function findById($id);

}