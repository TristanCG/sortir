<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\City;
use App\Entity\Outside;

use App\Entity\Place;
use App\Repository\CityRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class OutsideType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('name', TextType::class,
            [
                'label' => 'Nom de la sortie : '
            ])

            ->add('dateTimeStart', DateType::class,
            [
                'label' => 'Date et heure de la sortie : '
            ])

            ->add('dateLimitRegister', DateType::class,
            [
                'label' => ' Date limite d\'incription : '
            ])

            ->add('registerMax', IntegerType::class,
            [
                'label' => 'Nombre de place : '
            ])

            ->add('duration', IntegerType::class,
            [
                'label' => 'Durée : '
            ])

            ->add('information', TextareaType::class,
            [
                'label' => 'Description et infos : '
            ])

            ->add('city',EntityType::class,
            [
                'class' => City::class,
                'mapped' => false,
                'required' => false,
                'choice_label' => 'name'
            ])

        ->add('place', EntityType::class,
              [
                'class' => Place::class,
                'mapped' => false,
                'required' => false,
                'choice_label' => 'name'
              ]);


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Outside::class,
        ]);
    }
}
