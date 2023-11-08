<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Entity\Campus;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, ['label' => 'Email'])
            ->add('roles', ChoiceType::class, [
                'multiple' => true,
                'expanded' => false,
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Administrateur' => 'ROLE_ADMIN',
                ],
            ])
            ->add('lastname', TextType::class, ['label' => 'Nom'])
            ->add('firstname', TextType::class, ['label' => 'Prénom'])
            ->add('nickname', TextType::class, ['label' => 'Pseudo', 'required' => false ])
            ->add('password', PasswordType::class, ['label' => 'Mot de passe'])
            ->add('phone', TelType::class, ['label' => 'Téléphone', 'required' => false ])
            ->add('active', HiddenType::class, [
                'data' => true,  // Définir la valeur par défaut sur true
                'mapped' => false,  // Ne pas associer ce champ au formulaire
            ])
            ->add('campus', EntityType::class, [
                'class' => Campus::class, // Remplacez 'Campus' par le nom de votre entité Campus
                'choice_label' => 'name', // Le champ 'name' de l'entité Campus sera utilisé pour l'affichage des options
                'choice_value' => 'id', // Le champ 'id' de l'entité Campus sera utilisé pour les valeurs des options
                'label' => 'Campus',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
