<?php

namespace App\Form;

use App\Entity\AvBase;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvBaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
             $classe = [
                 'AVPI' => 'AVPI',
                 'AVPII' => 'AVPII',
                 'AVF' => 'AVF',
             ];

        $builder
            ->add('nota_max', NumberType::class,[
                'label' => 'Nota da Avaliação:',
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ]
            ])
            ->add('id_tipo', EntityType::class,[
                'class' => 'App:AvTipo',
                'label' => 'Tipo de Avaliação:',
                'choice_label' => function ($avtipo) {
                    return $avtipo->getTipo();
                },
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ]
            ])
            ->add('descricao', ChoiceType::class,[
                'choices' => [
                    '' => $classe
                ],
                'label' => 'Descrição:',
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'margin-bottom:15px'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AvBase::class,
        ]);
    }
}