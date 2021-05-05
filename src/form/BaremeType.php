<?php

namespace App\form;

use App\Entity\Bareme;
use App\Entity\Tranche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class BaremeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('anneeAt')
            ->add('tranches', CollectionType::class, [
                'entry_type' => TrancheType::class,
                'entry_options' => [
                    'label' => false,
                ],
                'prototype' => true,
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true
            ])
;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bareme::class,
        ]);
    }
}
