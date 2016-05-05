<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class DoctrineORMUserRepository extends EntityRepository implements UserRepositoryInterface
{
    /**
     * @param User $user
     */
    public function save(User $user)
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    /**
     * @return \AppBundle\Entity\User[]|array
     */
    public function findAll()
    {
        return $this->findAll();
    }

    /**
     * @param $name
     * @return User[]
     */
    public function findByName($name)
    {
        return $this->findBy([
            'name' => $name,
        ]);
    }
}
