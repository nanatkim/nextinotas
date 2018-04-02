<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nome:',
                'attr' => [
                    'class' => 'form-control input-sm chat-input',
                    'style' => 'margin-bottom:15px'
                ]
            ])
            ->add('email', EmailType::class,[
                'label' => 'Email:',
                'attr' => [
                    'class' => 'form-control input-sm chat-input',
                    'style' => 'margin-bottom:15px'
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Password',
                    'attr'=>[
                        'class' => 'password-field form-control',
                        'style' => 'margin-bottom: 15px'
                    ]],
                'second_options' => ['label' => 'Confirm Password',
                    'attr'=>[
                        'class' => 'password-field form-control',
                        'style' => 'margin-bottom: 15px'
                    ]],
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Done',
                'attr' => [
                    'class' => 'btn btn-primary',
                    'style' => 'margin-bottom:15px'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}