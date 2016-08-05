<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ClmAccount;
use AppBundle\Exception\ClmAccountRepositoryException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;


class DoctrineORMClmAccountRepository extends EntityRepository implements ClmAccountRepositoryInterface
{

    /**
     * @return ClmAccount[]
     */
    public function findAll()
    {
        return $this->findBy(array(), array('accountName' => 'ASC'));
    }

    /**
     * @param ClmAccount $clmAccount
     * @throws ClmAccountRepositoryException
     */
    public function save(ClmAccount $clmAccount)
    {
        $this->getEntityManager()->persist($clmAccount);
        try {
            $this->getEntityManager()->flush();
        } catch (UniqueConstraintViolationException $e) {
            throw new ClmAccountRepositoryException('Tried to save account with duplicate Accountname.', null, $e);
        }
    }

    /**
     * @param ClmAccount $account
     * @return void
     */
    public function merge(ClmAccount $account)
    {
        $this->getEntityManager()->merge($account);
        $this->getEntityManager()->flush();
    }

    /**
     * @param $name
     * @return ClmAccount
     * @throws ClmAccountRepositoryException
     */
    public function findOneByName($name)
    {

        $query = $this->createQueryBuilder('b')
            ->where('b.accountName = :parName')
            ->setParameter('parName', $name)
            ->getQuery();

        try {
            return $query->getSingleResult();
        } catch (NoResultException $e) {
            throw new ClmAccountRepositoryException('Account not found by name', null, $e);
        } catch (NonUniqueResultException $e) {
            throw new ClmAccountRepositoryException('Found more than one account', null, $e);
        }
    }
}
