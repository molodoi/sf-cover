<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoverType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Your firstname',
                    'class' => 'w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm',
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Your lastname',
                    'class' => 'w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm',
                ]
            ])
            ->add('degrees', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Your degrees (ex: Master, Bachelor)',
                    'class' => 'w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm',
                ]
            ])
            ->add('company', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Target company (ex: IBM)',
                    'class' => 'w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm',
                ]
            ])
            ->add('job', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Target job (ex: web developper)',
                    'class' => 'w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm',
                ]
            ])
            ->add('offer', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Job offer description..',
                    'class' => 'w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm',
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Generate cover letter',
                'attr' => [
                    'placeholder' => 'Generate cover letter',
                    'class' => 'block rounded-md bg-teal-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-teal-700',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
