<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',TextType::class,[
                'required' => false,
                'label' => 'Votre prénom',
                'attr' => [
                    'placeholder' => 'Tapez votre prénom...'
                ]
            ])
            ->add('lastName',TextType::class,[
                'required' => false,
                'label' => 'Votre nom de famille',
                'attr' => [
                    'placeholder' => 'Tapez votre nom de famille...'
                ]
            ])
            ->add('country',TextType::class,[
                'required' => false,
                'label' => 'Pays de livraison',
                'attr' => [
                    'placeholder' => 'Tapez le pays de livraison...'
                ]
            ])
            ->add('city',TextType::class,[
                'required' => false,
                'label' => 'Ville de livraison',
                'attr' => [
                    'placeholder' => 'Tapez la ville de livraison...'
                ]

            ])
            ->add('postalCode',TextType::class,[
                'required' => false,
                'label' => 'Code postal de la ville',
                'attr' => [
                    'placeholder' => 'Tapez le code postal...'
                ]
            ])
            ->add('street',TextType::class, [
                'required' => false,
                'label' => 'Rue de livraison',
                'attr'=> [
                    'placeholder' => 'Tapez la rue de livraison et le numéro...'
                ]
            ])
            ->add('phoneNumber',TextType::class, [
                'required' => false,
                'label' => 'Votre téléphone',
                'attr' => [
                    'placeholder' => 'Tapez votre numéro de téléphone...'
                ]
            ])
            ->add('email',EmailType::class, [
                'required' => false,
                'label' => 'Votre adresse email',
                'attr' => [
                    'placeholder' => 'Tapez votre adresse email...'
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne sont pas similaires.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'mapped' => false,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmer votre mot de passe'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
