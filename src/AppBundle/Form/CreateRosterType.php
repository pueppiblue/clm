<?php

namespace AppBundle\Form;


use AppBundle\Entity\ClmRaid;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateRosterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $characters = $options['default_characters'];
        $builder
            ->add(
                'participants',
                ChoiceType::class,
                [
                    'label' => 'Participants',
                    'choices' => [
                        $characters,
                    ],
                    'choice_label' => 'charName'
                    ,
                ]
            )
            ->add(
                'raidTier',
                ChoiceType::class,
                [
                    'label' => 'Raid Tier',
                    'choices' => [
                        'T4' => 'T4',
                        'T5' => 'T5',
                        'T6' => 'T6',
                    ],
                ]
            )
            ->add('date', DateType::class, ['label' => 'Raid Beginn', 'widget' => 'single_text']);
    }

    public
    function configureOptions(
        OptionsResolver $resolver
    ) {
        $resolver->setDefaults(
            array(
                'default_characters' => null,
                'data_class' => ClmRaid::class,
            )
        );
    }

}
