<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Hobby;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class HobbyType
 * @package App\Form
 */
class HobbyType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name", TextType::class, [
                "label" => false,
                "attr" => [
                    "placeholder" => "Enter the name of the hobby.."
                ]
            ])
        ;
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault("data_class", Hobby::class);
    }
}
