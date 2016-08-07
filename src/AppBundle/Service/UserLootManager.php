<?php

namespace AppBundle\Service;

use AppBundle\Repository\ClmAccountRepositoryInterface;
use AppBundle\Repository\ClmRaidRepositoryInterface;

class UserLootManager
{
    /**
     * @var ClmAccountRepositoryInterface
     */
    private $accountRepository;
    /**
     * @var ClmRaidRepositoryInterface
     */
    private $raidRepository;


    /**
     * UserLootManager constructor.
     * @param ClmAccountRepositoryInterface $accountRepository
     * @param ClmRaidRepositoryInterface $raidRepository
     */
    public function __construct(
        ClmAccountRepositoryInterface $accountRepository,
        ClmRaidRepositoryInterface $raidRepository
    )
    {
       $this->accountRepository = $accountRepository;
       $this->raidRepository = $raidRepository;
    }

    /**
     * @return \AppBundle\Entity\ClmAccount[]
     */
    public function getAllAccounts()
    {
        return $accounts = $this->accountRepository->findAll();

    }

    /**
     * @param $id
     * @return null
     */
    public function getAccount($id)
    {
        $account = $this->accountRepository->findBy(['id' => $id]);

        if ($account) {
            return $account[0];
        }

        return null;
    }
}
