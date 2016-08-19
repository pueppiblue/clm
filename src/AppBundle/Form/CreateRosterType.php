<?php

namespace AppBundle\Form;


use AppBundle\Entity\ClmCharacter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateRosterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Participants', ClmCharacter::class, array('widget' => 'CollectionType'))
            ->add('Start Raid', SubmitType::class);
    }
}
