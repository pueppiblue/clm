<?php
namespace AppBundle\Service;

use AppBundle\Entity\ClmAccount;
use JMS\Serializer\Serializer;
use Symfony\Component\DomCrawler\Crawler;

class ClmXmlDeserializer
{

    /**
     * @var Serializer
     */
    private $serializer;
    /**
     * @var string
     */
    private $account;

    /**
     * clmXmlDeserializer constructor.
     * @param Serializer $serializer
     */
    public function  __construct(Serializer $serializer)
    {
       $this->serializer = $serializer;
    }

    public function deserializeAccounts()
    {
        $xmlData = <<<EOT
<?xml version="1.0" encoding="utf-8"?>
<AS.Overlay>
    <settings>
        <setting name="aocfolder" value="D:\Games\Age of Conan\scripts" />
        <setting name="usemaintwink" value="false" />
    </settings>
    <accounts>
        <account player_name="Anat" tear="55" relic="55" weapon="551" accessoire="51" item="31">
             <chars>
                <char name="Morituro" class="Nekromant" set="Kein" main="False" />
                <char name="Ryjanna" class="Bärenschamane" set="Kein" main="False" />
                <char name="Impeto" class="Barbar" set="Kein" main="False" />
                <char name="Thraex" class="Eroberer" set="Schutz" main="False" />
                <char name="Infausta" class="HeroldDesXotli" set="Kein" main="False" />
                <char name="Murmilla" class="Wächter" set="Kein" main="True" />
             </chars>
        </account>
        <account player_name="NilseBaer" tear="22" relic="55" weapon="551" accessoire="51" item="31">
        </account>
    </accounts>
</AS.Overlay>
EOT;
//        $account = new ClmAccount('Nilsebaer');
//        $account->setTear(55);
//
//        $accounts = [ $account, new ClmAccount('Anat')];
//
//        $testXML = $this->serializer->serialize($accounts, 'xml' );
//        dump($testXML);

        $crawler = new Crawler($xmlData);
        $attributes = $crawler
            ->filterXpath('//accounts/account')
            ->extract(array('player_name', 'tear', 'relic', 'chars'));
        dump($attributes);

        $crawler = new Crawler($xmlData);
        dump($crawler->html());
        $crawler = new Crawler();
        $crawler->addXmlContent($xmlData);
        dump($crawler->html());
        $crawler = $crawler->filter('accounts')->children();
        dump($crawler->html());

        die;

//        $this->serializer = $serializer;
//
//        $user = $this->serializer->deserialize(
//            $xmlData, 'User[]', 'xml');
//
//        dump($user);
//        die();
    }





}
