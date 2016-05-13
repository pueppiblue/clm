<?php
namespace AppBundle\Service;

use AppBundle\Entity\ClmAccount;
use AppBundle\Entity\ClmCharacter;
use AppBundle\Repository\ClmAccountRepositoryInterface;
use AppBundle\Repository\ClmCharacterRepositoryInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ClmXmlDeserializer
{
    private $accountRepository;
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
        die();
        
//        dump($crawler->filterXPath('//accounts//chars')->html());
//        dump($crawler->filterXPath('//accounts/account')->html());
//        dump($crawler->filterXPath('//accounts/account/chars')->html());

//        $xml = $crawler->filterXPath('//accounts/account[1]');
//        dump($this->serializer->deserialize(
//            $xml,
//            'AppBundle\Entity\ClmAccount',
//            'xml'
//        ));

//
//        $attributes = $crawler
//            ->filterXpath('//accounts/account')
//            ->extract(array('player_name', 'tear', 'relic', 'chars'));
//        dump($attributes['0']['0']);
//

    }


    /**
     * @param Crawler $crawler
     * @return array
     */
    private function getAccounts(Crawler $crawler)
    {
        $accounts =  $crawler->filterXPath('//accounts/account')->each(function (Crawler $node) {
            $account = new ClmAccount($node->attr('player_name'));
            $account->setTear($node->attr('tear'));
            $characters = $this->getCharacters($node);
            $account->setCharacters($characters);
            return $account;
        });
        return $accounts;
    }

    /**
     * @param Crawler $crawler
     * @return array
     */
    private function getCharacters(Crawler $crawler)
    {
        $characters = $crawler->filterXPath('//account/chars/char')->each(function (Crawler $node) {
            return $node->attr('name');
        });

        return $characters;
    }




}
