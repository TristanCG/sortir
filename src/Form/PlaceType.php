<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Place;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class PlaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('name', null,
            [
                'label' => 'Place : ',
                'constraints' =>
                [new NotBlank(
                    [
                        'message' => 'Ce champ ne peux pas être vide',
                    ]),
                 new Length(
                     [
                         'min'=> 2,
                         'max' => 255,
                     ]),
                ],
                'required' => false
            ])

            ->add('street', null,
            [
                'label' => 'Rue : ',
                'constraints' =>
                    [
                        new NotBlank(
                            [
                                'message' => 'Ce champ ne peux pas être vide',
                            ]),
                        new Length(
                            [
                                'min'=> 2,
                                'max' => 255,
                            ]),
                    ],
                    'required' => true,
            ])

            ->add('latitude',IntegerType::class,
            [
                'label' => 'Latitude : ',
                'constraints' =>
                    [
                        new NotBlank(
                            [
                                'message' => 'Ce champ ne peux pas être vide',
                            ]),
                    ],
                'required' => false,
            ])

            ->add('longitude', IntegerType::class,
            [
                'label' => 'Longitude : ',
                'constraints' =>
                    [
                        new NotBlank(
                            [
                                'message' => 'Ce champ ne peux pas être vide',
                            ]),
                    ],
                    'required' => false,
            ])
            ->add('city',EntityType::class,
                (['class' => City::class])
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Place::class,
        ]);
    }
}
