<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Profile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('lastname', TextType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('sex', TextType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('title', TextType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('country', CountryType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('state', TextType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('street', TextType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('houseNumber', NumberType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('postcode', NumberType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('birthdayDate', DateTimeType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('nationality', CountryType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('phone', TelType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('linkdIn', UrlType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('facebook', UrlType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('tweeter', UrlType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('skype', UrlType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('brochure', FileType::class, [
                'label' => false,

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k'
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
        ]);
    }
}
