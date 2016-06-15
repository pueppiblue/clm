<?php

namespace AppBundle\Service;

use AppBundle\Repository\ClmAccountRepositoryInterface;

class UserLootManager
{
    /**
     * @var ClmAccountRepositoryInterface
     */
    private $accountRepository;

    /**
     * @param ClmAccountRepositoryInterface $accountRepository
     */
    public function __construct(ClmAccountRepositoryInterface $accountRepository)
    {
       $this->accountRepository = $accountRepository;
    }

    /**
     * @return \AppBundle\Entity\ClmAccount[]
     */
    public function getAllAccounts()
    {
        $accounts = $this->accountRepository->findAll();

        return $accounts;
    }

    public function getAccount($id)
    {
        $account = $this->accountRepository->findBy(['id' => $id]);

        return $account[0];

    }
}
