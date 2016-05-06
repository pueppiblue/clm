<?php
namespace AppBundle\Service;

use AppBundle\Entity\User;
use JMS\Serializer\Serializer;


class clmXmlDeserializer
{

    /**
     * @var Serializer
     */
    private $serializer;
    /**
     * @var string
     */
    private $user;

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
<result name="Anat" tear="55" relic="55" weapon="551" accessoire="51" item="31">
</result>
EOT;
        $users = $this->user = $this->serializer->deserialize(
            $xmlData, 'AppBundle\Entity\User', 'xml');

        var_dump($users);

    }





}
