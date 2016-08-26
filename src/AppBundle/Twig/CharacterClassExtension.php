<?php

namespace AppBundle\Twig;


use Symfony\Component\Form\FormView;
use Twig_Extension;
use Twig_SimpleFilter;

class CharacterClassExtension extends Twig_Extension
{

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'character_class_extension';
    }

    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('healer', [$this, 'healerFilter']),
            new Twig_SimpleFilter('soldier', [$this, 'soldierFilter']),
            new Twig_SimpleFilter('rogue', [$this, 'rogueFilter']),
            new Twig_SimpleFilter('mage', [$this, 'mageFilter']),
        ];
    }


    /**
     * @param FormView[] $characters
     * @return array
     */
    public function healerFilter($characters)
    {
        $healers = [];
        /**@var FormView $character */
        foreach ($characters as $character) {
            $charClass = $character->vars['attr']['data-character-class'];
            if (in_array($charClass, ['ToS', 'PoM', 'BS'], false)) {
                $healers[] = $character;
            }
        }

        return $healers;
    }

    /**
     * @param FormView[] $characters
     * @return array
     */
    public function rogueFilter($characters)
    {
        $rogues = [];
        /**@var FormView $character */
        foreach ($characters as $character) {
            $charClass = $character->vars['attr']['data-character-class'];
            if (in_array($charClass, ['Assa', 'Barb', 'Ranger'], false)) {
                $rogues[] = $character;
            }
        }

        return $rogues;
    }

    /**
     * @param FormView[] $characters
     * @return array
     */
    public function soldierFilter($characters)
    {
        $soldiers = [];
        /**@var FormView $character */
        foreach ($characters as $character) {
            $charClass = $character->vars['attr']['data-character-class'];
            if (in_array($charClass, ['DT', 'Waechter', 'Ero'], false)) {
                $soldiers[] = $character;
            }
        }

        return $soldiers;
    }

    /**
     * @param FormView[] $characters
     * @return array
     */
    public function mageFilter($characters)
    {
        $mages = [];
        /**@var FormView $character */
        foreach ($characters as $character) {
            $charClass = $character->vars['attr']['data-character-class'];
            if (in_array($charClass, ['HoX', 'Nec', 'Demo'], false)) {
                $mages[] = $character;
            }
        }

        return $mages;
    }
}
