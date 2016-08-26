<?php

namespace AppBundle\Service;

use AppBundle\Entity\ClmAccount;
use AppBundle\Entity\ClmCharacter;
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
     * @return ClmCharacter[]
     */
    public function getAllCharacters()
    {
        $accounts = $this->getAllAccounts();
        $characters = [];

        foreach ($accounts as $account)
        {
            foreach ($account->getCharacters() as $character)
            {
                $characters[] = $character;
            }
        }

        return $characters;
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

    /**
     * @param $id
     * @return ClmRaid
     */
    public function getRaid($id)
    {
        return $this->raidRepository->findById($id);
    }

    /**
     * @param ClmRaid $raid
     */
    public function saveRaid(ClmRaid $raid)
    {
        $this->raidRepository->save($raid);
    }

}
