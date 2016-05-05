<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;

interface UserRepositoryInterface
{

    /**
     * @param User $user
     */
    public function save(User $user);

    /**
     * @return User[]
     */
    public function findAll();

    /**
     * @param $name
     * @return User[]
     */
    public function findByName($name);
}
