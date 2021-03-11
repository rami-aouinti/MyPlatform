<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Skill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SkillType
 * @package App\Form
 */
class SkillType extends AbstractType
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
                    "placeholder" => "Enter the name of the skill.."
                ]
            ])
            ->add("level", RangeType::class, [
                "label" => false,
                "attr" => [
                    "min" => 1,
                    "max" => 10
                ]
            ])
        ;
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault("data_class", Skill::class);
    }
}
