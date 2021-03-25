<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Attribute;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AttributeType
 * @package App\Form
 */
class AttributeType extends AbstractType
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
                    "placeholder" => "Enter the name of the Project.."
                ]
            ])
            ->add("description", TextareaType::class, [
                "label" => false,
                "attr" => [
                    "placeholder" => "Enter the description of the project.."
                ]
            ])
            ->add("url", UrlType::class, [
                "label" => false,
                "attr" => [
                    "placeholder" => "Enter the url of the project.."
                ]
            ])
        ;
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault("data_class", Attribute::class);
    }
}
