<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ClmRaid;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Config\Definition\Exception\Exception;

class DoctrineORMClmRaidRepository extends EntityRepository implements ClmRaidRepositoryInterface
{
    /**
     * @param ClmRaid $raid
     */
    public function save(ClmRaid $raid)
    {
        $em = $this->getEntityManager();

        $em->persist($raid);
        $em->flush();
    }

    /**
     * @param int $id
     * @return ClmRaid
     */
    public function findById($id)
    {
        $query = $this->createQueryBuilder('b')
            ->where('b.id = :parId')
            ->setParameter('parId', $id)
            ->getQuery();

        try {
            return $query->getSingleResult();
        } catch (NoResultException $e) {
            throw new Exception('Raid not found by ID', null, $e);
        }
    }

}
