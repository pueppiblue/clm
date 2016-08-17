<?php

namespace AppBundle\Service;

use AppBundle\Entity\ClmAccount;
use AppBundle\Entity\ClmRaid;
use AppBundle\Repository\ClmAccountRepositoryInterface;
use AppBundle\Repository\ClmRaidRepositoryInterface;
use Doctrine\ORM\NoResultException;

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
     * @return ClmAccount
     * @throws NoResultException
     */
    public function getAccount($id)
    {
        $account = $this->accountRepository->findBy(['id' => $id]);

        if (!$account) {
            throw new NoResultException();
        } else {

            return $account[0];
        }
    }

    /**
     * @return ClmRaid[]
     */
    public function getAllRaids()
    {
        return $raids = $this->raidRepository->findAll();

    }

    public function getRaid($id)
    {
        return $this->raidRepository->findById($id);
    }

}
