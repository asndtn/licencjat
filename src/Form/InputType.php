<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Category;
use App\Entity\Field;
use App\Entity\Input;
use App\Entity\Movement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeExtensionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InputType extends AbstractType
{
    /**
     * Builds the form.
     *
     * This method is called for each type in the hierarchy starting from the
     * top most type. Type extensions can further modify the form.
     *
     * @param array<string, mixed> $options
     *
     * @see FormTypeExtensionInterface::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'artist',
            EntityType::class,
            [
                'class' => Artist::class,
                'choice_label' => function ($artist) {
                    return $artist->getName();
                },
                'label' => 'label.artist',
                'placeholder' => 'label.none',
                'required' => true,
            ]
        );

        $builder->add(
            'category',
            EntityType::class,
            [
                'class' => Category::class,
                'choice_label' => function ($category) {
                    return $category->getName();
                },
                'label' => 'label.category',
                'placeholder' => 'label_none',
                'required' => true,
            ]
        );

        $builder->add(
            'field',
            EntityType::class,
            [
                'class' => Field::class,
                'choice_label' => function ($field) {
                    return $field->getName();
                },
                'label' => 'label.field',
                'placeholder' => 'label_none',
                'required' => true,
            ]
        );

        $builder->add(
            'movement',
            EntityType::class,
            [
                'class' => Movement::class,
                'choice_label' => function ($movement) {
                    return $movement->getName();
                },
                'label' => 'label.movement',
                'placeholder' => 'label_none',
                'required' => true,
            ]
        );

        $builder->add(
            'title',
            TextType::class,
            [
                'label' => 'label.title',
                'required' => true,
                'attr' => ['max_length' => 90],
            ]
        );

        $builder->add(
            'description',
            TextType::class,
            [
                'label' => 'label.description',
                'required' => true,
                'attr' => ['max_length' => 255],
            ]
        );
    }

    /**
     * Configures the options for this type.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Input::class]);
    }

    /**
     * Returns the prefix of the template block name for this type.
     *
     * The block prefix defaults to the underscored short class name with
     * the "Type" suffix removed (e.g. "UserProfileType" => "user_profile").
     */
    public function getBlockPrefix(): string
    {
        return 'input';
    }
}
