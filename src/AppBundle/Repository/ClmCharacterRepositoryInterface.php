<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ClmCharacter;

interface ClmCharacterRepositoryInterface
{

    /**
     * @param ClmCharacter $character
     */
    public function save(ClmCharacter $character);

    /**
     * @return ClmCharacter[]
     */
    public function findAll();

    /**
     * @param $name
     * @return ClmCharacter[]
     */
    public function findByName($name);
}
