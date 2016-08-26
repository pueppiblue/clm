<?php

namespace AppBundle\Form;


use AppBundle\Entity\ClmAccount;
use AppBundle\Entity\ClmCharacter;
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
                    'choices' =>
                        $characters,
                    'choice_label' =>
                        function ($character) {
                            /**@var ClmCharacter $character */
                            /**@var ClmAccount $account */
                            return sprintf(
                                '%s (%s)',
                                $character->getCharName(),
                                $character->getAccount()->getAccountName()
                            );
                        },
                    'choice_attr' =>
                        function ($character) {
                            /**@var ClmCharacter $character */
                            /**@var ClmAccount $account */
                            return [
                                'data-raider-id' => $character->getAccount()->getId(),
                                'data-character-class' => $character->getClmClass(),
                            ];
                        },
                    'group_by' => 'clmClass',
                    'multiple' => true,
                    'expanded' => true,
                    'placeholder' => null,
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
            ->add('date', DateType::class, ['label' => 'Raid Beginn', 'widget' => 'single_text', 'format' => 'dd MMMM, y']);
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
