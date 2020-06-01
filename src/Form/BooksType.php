<?php

namespace App\Form;

use App\Entity\Books;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BooksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('BookTitle', TextType::class)
            ->add('OriginalTitle', TextType::class)
            ->add('YearofPublication', IntegerType::class)
            ->add('Genre', TextType::class)
            ->add('MillionsSold', IntegerType::class)
            ->add('LanguageWritten', TextType::class)
            ->add('coverImagePath', UrlType::class)
            ->add('Author', IntegerType::class)
            ->add('Plot', TextareaType::class)
            ->add('PlotSource', TextType::class)
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Books::class,
        ]);
    }
}
