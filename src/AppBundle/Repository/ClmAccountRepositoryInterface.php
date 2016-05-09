<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ClmAccount;

interface ClmAccountRepositoryInterface
{

    /**
     * @param ClmAccount $user
     */
    public function save(ClmAccount $user);

    /**
     * @return ClmAccount[]
     */
    public function findAll();

    /**
     * @param $name
     * @return ClmAccount[]
     */
    public function findByName($name);
}
