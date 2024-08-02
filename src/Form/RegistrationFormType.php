<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse mail',
            ])
            ->add('username', TextType::class, [
                'label' => 'Username',
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Mot de passe',
                'always_empty' => false,
                'toggle' => true,
                'hidden_label' => 'Masquer',
                'visible_label' => 'Afficher',
            ])
            ->add('repeatedPassword', PasswordType::class, [
                'label' => 'Confirmez le mot de passe',
                'always_empty' => false,
                'mapped' => false,
                'toggle' => true,
                'hidden_label' => 'Masquer',
                'visible_label' => 'Afficher',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Veuillez confirmer le mot de passe',
                    ]),
                ],
                'attr' => [
                    'autocomplete' => 'new-password',
                ],
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom de famille',
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse',
            ])
            ->add('complementAddress', TextType::class, [
                'label' => 'Complément d\'adresse',
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'Code Postal',
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'J\'accepte les termes et conditions',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos termes.',
                    ]),
                ]
            ])
        ;

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();

            $password1 = $form->get('plainPassword')->getData();
            $password2 = $form->get('repeatedPassword')->getData();

            if ($password1 !== $password2) {
                $form->get('repeatedPassword')->addError(new FormError('Les champs de mot de passe doivent correspondre.'));
            }
        });

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
