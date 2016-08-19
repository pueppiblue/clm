<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateRosterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roster', CollectionType::class)
            ->add('raidTier', ChoiceType::class, [
                'label' => 'Raid Tier',
                'choices' => [
                    'T4' => 'T4',
                    'T5' => 'T5',
                    'T6' => 'T6'
                ]])
            ->add('raidStart', DateTimeType::class, ['label' => 'Raid Beginn', 'widget' => 'single_text'])
            ->add('raidEnd', DateTimeType::class, ['label' => 'Raid Ende', 'widget' => 'single_text'])
            ->add('save', SubmitType::class, array('label' => 'Start Raid'));
    }
}
