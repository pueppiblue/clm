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
     * ClmXmlDeserializer constructor.
     * @param ClmAccountRepositoryInterface $accountRepository
     * @param ClmCharacterRepositoryInterface $characterRepository
     */
    public function  __construct(
        ClmAccountRepositoryInterface $accountRepository,
        ClmCharacterRepositoryInterface $characterRepository)
    {
        $this->accountRepository = $accountRepository;
        $this->characterRepository = $characterRepository;
    }

    /**
     * @param UploadedFile $file
     * @return ArrayCollection
     */
    public function deserializeAccounts(UploadedFile $file)
    {
        $fileInfo = new SplFileInfo(
            $file,
            $file->getRealPath(),
            $file->getFilename());
        $xmlData = $fileInfo->getContents();

        $crawler = new Crawler();
        $crawler->addXmlContent($xmlData, 'UTF-8');

        $accounts = $this->getAccounts($crawler);

        return $accounts;
    }


    /**
     * @param Crawler $crawler
     * @return ArrayCollection
     */
    private function getAccounts(Crawler $crawler)
    {
        $accounts =  array();

        // The crawlers each function can return null elements to array
        // so we inherit a parrent array and manually set its values
        // and forfeit the array returned by the crawlers each closure
        $crawler->filterXPath('//accounts/account')->each(function (Crawler $node, $i) use (&$accounts) {
            $name = $node->attr('name');

            $account = $this->accountRepository->findBy(array('accountName' => $name));

            if (!$account) {
                $account = new ClmAccount($name);
                $account
                    ->setTear($node->attr('tear'))
                    ->setWeapon($node->attr('weapon'))
                    ->setUrn($node->attr('relic'))
                    ->setItem($node->attr('item'))
                    ->setAcc($node->attr('accessoire'));
                $this->saveAccount($account);

                $characters = $this->getCharacters($node);
                $this->saveCharactersToAccount(new ArrayCollection($characters), $account);

                $accounts[]= $account;
            }
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
                ->setClmClass($node->attr('class'))
                ->setPreferredSet(
                ($node->attr('set')) != 'Kein' ? ($node->attr('set')) : ''
            );

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
