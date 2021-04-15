<?php

namespace App\form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, array(
//                    'attr'  =>  array('class' => 'form-control',
//                        'style' => 'margin:5px 0;'),
                    'choices' =>
                        array
                        (
                            'ROLE_GEST' => 'ROLE_GEST',
                        ),
                    'multiple' => true,
                    'required' => true,
                )
            )
//            ->add('roles', HiddenType::class, array(
//                'data' => ['ROLE_GEST'],
//            )) // erreur array to string convertion
            ->add('password')
            ->add('nom')
            ->add('prenom')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
