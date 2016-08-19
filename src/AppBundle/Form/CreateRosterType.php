<?php

namespace AppBundle\Form;


use AppBundle\Entity\ClmCharacter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateRosterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roster', CollectionType::class)
            ->add('save', SubmitType::class, array('label' => 'Start Raid'));
    }
}
