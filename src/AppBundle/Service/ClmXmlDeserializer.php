<?php
namespace AppBundle\Service;

use AppBundle\Entity\ClmAccount;
use AppBundle\Entity\ClmCharacter;
use AppBundle\Repository\ClmAccountRepositoryInterface;
use AppBundle\Repository\ClmCharacterRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ClmXmlDeserializer
{
    /**
     * @var ClmAccountRepositoryInterface
     */
    private $accountRepository;
    /**
     * @var ClmCharacterRepositoryInterface
     */
    private $characterRepository;
    
    /**
     * clmXmlDeserializer constructor.
     */
    public function  __construct(
        ClmAccountRepositoryInterface $accountRepository,
        ClmCharacterRepositoryInterface $characterRepository)
    {
        $this->accountRepository = $accountRepository;
        $this->characterRepository = $characterRepository;
    }

    /**
     *
     */
    public function deserializeAccounts(UploadedFile $file)
    {
        $fileInfo = new SplFileInfo(
            $file,
            $file->getRealPath(),
            $file->getFilename());
        $xmlData = $fileInfo->getContents();
        
        $crawler = new Crawler($xmlData);

        dump($crawler->html());

        $accounts = $this->getAccounts($crawler);
        dump($accounts);

//        $this->saveAccounts(new ArrayCollection($accounts));

        return $accounts;
    }


    /**
     * @param Crawler $crawler
     * @return ArrayCollection
     */
    private function getAccounts(Crawler $crawler)
    {
        $accounts =  $crawler->filterXPath('//accounts/account')->each(function (Crawler $node) {
            $account = new ClmAccount($node->attr('player_name'));
            $account
                ->setTear($node->attr('tear'))
                ->setWeapon($node->attr('weapon'))
                ->setUrn($node->attr('relic'))
                ->setItem($node->attr('item'))
                ->setAcc($node->attr('accessoire'));
            $this->accountRepository->save($account);

            $characters = $this->getCharacters($node);
            $this->saveCharactersToAccount(new ArrayCollection($characters), $account);


            return  $account;
        });

        return $accounts;
    }

    /**
     * @param Crawler $crawler
     * @return ArrayCollection
     */
    private function getCharacters(Crawler $crawler)
    {
        $characters = $crawler->filterXPath('//account/chars/char')->each(function (Crawler $node) {
            $character = new ClmCharacter($node->attr('name'));
            $character
                ->setClmClass($node->attr('class'));

            return $character;
        });

        return $characters;
    }

    private function saveCharactersToAccount(ArrayCollection $characters, ClmAccount $account)
    {
        foreach ($characters as $character) {
            $character->setAccount($account);
            $this->characterRepository->save($character);
        }

    }

    /**
     * @param ArrayCollection $accounts
     */
    private function saveAccounts(ArrayCollection $accounts)
    {
        foreach ($accounts as $account) {
            $this->accountRepository->save($account);
        }
    }



}
