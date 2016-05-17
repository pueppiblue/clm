<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ClmAccount;
use AppBundle\Exception\ClmAccountRepositoryException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityRepository;

class DoctrineORMClmAccountRepository extends EntityRepository implements ClmAccountRepositoryInterface
{
    /**
     * @param ClmAccount $clmAccount
     * @throws UniqueConstraintViolationException
     */
    public function save(ClmAccount $clmAccount)
    {
        $this->getEntityManager()->persist($clmAccount);
        try {
            $this->getEntityManager()->flush();
        } catch (UniqueConstraintViolationException $e) {
            throw new ClmAccountRepositoryException('Tried to save acoount with duplicate Accountname.', null, $e);
        }
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
