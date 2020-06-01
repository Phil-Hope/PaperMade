<?php

namespace App\Form;

use App\Entity\Users;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('FirstName', TextType::class)
            ->add('LastName', TextType::class)
            ->add('roles', ChoiceType::class, array(
                'attr' => array('class' => 'form-control',
                    'style' => 'margin:5px 0;'),
                'choices' =>
                array
                (
                    'ROLE_ADMIN' => array
                    (
                        'Yes' => 'ROLE_ADMIN',
                    ),
                    'ROLE_SUPER_USER' => array
                    (
                        'Yes' => 'ROLE_SUPER_USER'
                    ),
                )
                ,
                'multiple' => true,
                'required' => true,
                )
            )
            ->add('password', RepeatedType::class,
                array('type' => PasswordType::class,
                    'first_options' => array('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password'),
                    ));}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
