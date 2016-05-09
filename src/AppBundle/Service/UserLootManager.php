<?php

namespace AppBundle\Service;

use AppBundle\Repository\ClmAccountRepositoryInterface;

class UserLootManager
{
    /**
     * @var ClmAccountRepositoryInterface
     */
    protected $accountRepository;

    /**
     * UserLootManager constructor.
     * @param ClmAccountRepositoryInterface $accountRepository
     */
    public function __construct(ClmAccountRepositoryInterface $accountRepository)
    {
        $this->$accountRepository = $accountRepository;
    }

    /**
     * @return \AppBundle\Entity\ClmAccount[]
     */
    public function getAllUsers()
    {
        $users = $this->accountRepository->findAll();

        return $users;
    }
}
