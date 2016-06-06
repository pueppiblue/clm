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
     * @return ClmAccount
     */
    public function findOneByName($name);

    /**
     * @param ClmAccount $account
     * @return mixed
     */
    public function merge(ClmAccount $account);

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

}
