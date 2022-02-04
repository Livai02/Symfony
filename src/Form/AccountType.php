<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                "label" => "Prenom",
                "attr" => ["placeholder" => "Votre prénom"]
            ])
            ->add('fullname', TextType::class, [
                "label" => "Nom de famille",
                "attr" => ["placeholder" => "Votre nom de famille"]
            ])
            ->add('email', EmailType::class, [
                "label" => "Email",
                "attr" => ["placeholder" => "Votre mail"]
            ])
            ->add('hash', PasswordType::class, [
                "label" => "mots de passe",
                "attr" => ["placeholder" => "votre mot de passe"]
            ])
            ->add('passwordConfirm', PasswordType::class, [
                "label" => "Confirmation du mots de passe",
                "attr" => ["placeholder" => "Retapez votre mot de passe"]
            ])
            ->add('presentation', TextType::class, [
                "label" => "",
                "attr" => ["placeholder" => "un petit mots pour vous présenter"]
            ])
            ->add('avatar', UrlType::class, [
                "label" => "lien de votre avatar",
                "attr" => ["placeholder" => "Coller un lien de votre avatar"]
            ])
            ->add('Inscription', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}