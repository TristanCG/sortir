<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Outside;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OutsideType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('name', TextType::class,
            [
                'label' => 'Nom de la sortie :',
                'placeholder' => 'Nom de la sortie'
            ])

            ->add('dateTimeStart', DateTimeType::class,
            [
                'label' => 'Date et heure de la sortie :'
            ])

            ->add('dateLimitRegister', DateTimeType::class,
            [
                'label' => ' Date limite d\'incription :'
            ])

            ->add('registerMax', IntegerType::class,
            [
                'label' => 'Nombre de place :'
            ])

            ->add('duration', IntegerType::class,
            [
                'label' => 'Durée'
            ])

            ->add('information', TextareaType::class,
            [
                'label' => 'Description et infos :'
            ])

            ->add('campus',EntityType::class,
            [
                'label' => 'Campus',
                'class' => Campus::class,
                'required' => false,
                'choice_label' => 'nom',
                'placeholder' => '--Choisir un campus --'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Outside::class,
        ]);
    }
}
