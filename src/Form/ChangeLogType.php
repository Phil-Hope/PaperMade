<?php

namespace App\Form;

use App\Entity\ChangeLog;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangeLogType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('DateCreated', DateTimeType::class)
            ->add('DateUpdated', DateTimeType::class)
            ->add('BookChanged')
            ->add('ChangedBy')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ChangeLog::class,
        ]);
    }

}
