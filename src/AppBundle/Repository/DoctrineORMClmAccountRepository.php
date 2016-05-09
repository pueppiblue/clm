<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ClmAccount;
use Doctrine\ORM\EntityRepository;

class DoctrineORMClmAccountRepository extends EntityRepository implements ClmAccountRepositoryInterface
{
    /**
     * @param ClmAccount $clmAccount
     */
    public function save(ClmAccount $clmAccount)
    {
        $this->getEntityManager()->persist($clmAccount);
        $this->getEntityManager()->flush();
    }

    /**
     * @param $name
     * @return ClmAccount[]
     */
    public function findByName($name)
    {
        return $this->findBy([
            'accountName' => $name,
        ]);
    }
}
