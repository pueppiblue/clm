<?php
namespace AppBundle\Service;

use AppBundle\Entity\ClmAccount;
use AppBundle\Entity\ClmCharacter;
use AppBundle\Exception\ClmAccountRepositoryException;
use AppBundle\Repository\ClmAccountRepositoryInterface;
use AppBundle\Repository\ClmCharacterRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ClmXmlDeserializer
 * @package AppBundle\Service
 */
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
            $name = $node->attr('name');
//            try {
//                $account = $this->accountRepository->findOneByName($name);
//            } catch(ClmAccountRepositoryException $e) {
//                throw $e;
//            }
//
//            if (!$account){
//                $account = new ClmAccount($node->attr('name'));
//            }

            $account = new ClmAccount($name);
            $account
                ->setTear($node->attr('tear'))
                ->setWeapon($node->attr('weapon'))
                ->setUrn($node->attr('relic'))
                ->setItem($node->attr('item'))
                ->setAcc($node->attr('accessoire'));
            
            $this->saveAccount($account);
            $account = $this->accountRepository->findOneByName($name);

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

    /**
     * @param ArrayCollection $characters
     * @param ClmAccount $account
     */
    private function saveCharactersToAccount(ArrayCollection $characters, ClmAccount $account)
    {
        foreach ($characters as $character) {
            $character->setAccount($account);
            $this->saveCharacter($character);
        }

    }

    /**
     * @param ClmAccount $account
     * @throws ClmAccountRepositoryException
     */
    private function saveAccount(ClmAccount $account)
    {
        try {
//            $this->accountRepository->merge($account);
            $this->accountRepository->save($account);
        } catch (ClmAccountRepositoryException $e) {
            throw $e;
        }
    }

    /**
     * @param ClmCharacter $character
     */
    private function saveCharacter(ClmCharacter $character)
    {
        $this->characterRepository->save($character);
    }



}
