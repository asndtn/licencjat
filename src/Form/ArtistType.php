<?php
/**
 * Artist type.
 */

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Nationality;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeExtensionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ArtistType.
 */
class ArtistType extends AbstractType
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
            'name',
            TextType::class,
            [
                'label' => 'label.name_surname',
                'required' => true,
                'attr' => ['max_length' => 64],
            ]
        );

        $builder->add(
            'dateOfBirth',
            DateType::class,
            [
                'input' => 'datetime_immutable',
                'label' => 'label.dateOfBirth',
                'years' => range(date('0'), date('Y')),
                'required' => true,
            ]
        );

        $builder->add(
            'dateOfDeath',
            DateType::class,
            [
                'input' => 'datetime_immutable',
                'label' => 'label.dateOfDeath',
                'years' => range(date('0'), date('Y')),
                'required' => false,
            ]
        );

        $builder->add(
            'nationality',
            EntityType::class,
            [
                'class' => Nationality::class,
                'choice_label' => function ($nationality) {
                    return $nationality->getName();
                },
                'label' => 'label.nationality',
                'placeholder' => 'label.none',
                'required' => true,
            ]
        );
    }

    /**
     * Configures the options for this type.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Artist::class]);
    }

    /**
     * Returns the prefix of the template block name for this type.
     *
     * The block prefix defaults to the underscored short class name with
     * the "Type" suffix removed (e.g. "UserProfileType" => "user_profile").
     */
    public function getBlockPrefix(): string
    {
        return 'artist';
    }
}
