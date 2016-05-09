<?php
namespace AppBundle\Service;

use AppBundle\Entity\ClmAccount;
use AppBundle\Entity\ClmCharacter;
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
            <chars>
                <char name="Rylt" class="HoX" set="Kein" main="False" />
                <char name="Corais" class="DT" set="Kein" main="False" />
                <char name="Nahraya" class="Barbar" set="Kein" main="False" />
                <char name="Skjardar" class="BS" set="Schutz" main="False" />
            </chars>
        </account>
    </accounts>
</AS.Overlay>
EOT;

        $crawler = new Crawler($xmlData);

        dump($crawler->html());

        $accounts = $crawler->filterXPath('//accounts/account')->each(function (Crawler $node) {
            $account = new ClmAccount($node->attr('player_name'));
            $account->setTear($node->attr('tear'));
            $characters = $node->filterXPath('//account/chars/char')->each(function (Crawler $cNode) {
                return $cNode->attr('name');
            });
            $account->setCharacters($characters);
            return $account;
        });
        dump($accounts);

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

        die();
    }





}
