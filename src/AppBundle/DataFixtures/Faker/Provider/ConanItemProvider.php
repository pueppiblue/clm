<?php

namespace AppBundle\DataFixtures\Faker\Provider;


use Faker\Provider\Base as BaseProvider;

class ConanItemProvider extends BaseProvider
{
    private $itemProvider = [
        'Brust',
        'Mainhand',
        'Stab',
        'Hose',
        'Helm',
        'Handgelenk',
        'Stiefel',
        'Haende',
        'Schultern',
        'Offhand'
    ];

    private $charNameProvider = [
        'Rylt', 'Ejakulat', 'Entenkiller', 'Wurzeltee', 'Posexdon',
        'Impedo', 'GrosseFresseNixDahinter', 'HäschenHerz', 'Fester Stöpsel',
        'OttoSchlagmichTot', 'OttohautDichTot', "Flitzebogen", 'Schweinerade',
        'Hasipupsi'
    ];

    private $classProvider = [
        'DT', 'Ero', 'BS', 'Waechter', 'ToS', 'PoM', 'Assa', 'Barb', 'Ranger','HoX', 'Nec', 'Demo'
    ];

    private $raidTierProvider = [
        'T4', 'T5', 'T6'
    ];

    /**
     * @return string
     */
    public function conanClass()
    {
        return self::randomElement($this->classProvider);
    }

    /**
     * @return string
     */
    public function conanCharName()
    {
        return self::randomElement($this->charNameProvider);
    }

    /**
     * @return string
     */
    public function conanRaidTier()
    {
        return self::randomElement($this->raidTierProvider);
    }

    /**
     * @return string
     */
    public function conanItem()
    {
        $items = [
            sprintf(
                '%s-%s',
                self::randomElement($this->classProvider),
                self::randomElement($this->itemProvider)
            )
        ];
        return self::randomElement($items);
    }
}
