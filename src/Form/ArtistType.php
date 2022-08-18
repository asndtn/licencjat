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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeExtensionInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

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
            'photo',
            FileType::class,
            [
                'label' => 'label.photo_req',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '4096k',
                            'mimeTypes' => [
                                'image/png',
                                'image/jpg',
                                'image/jpeg',
                            ],
                            'mimeTypesMessage' => 'Please upload a valid image',
                        ]),
                ],
            ]
        );

        $builder->add(
            'name',
            TextType::class,
            [
                'label' => 'label.name_surname_req',
                'required' => true,
                'attr' => ['max_length' => 64],
            ]
        );

        $builder->add(
            'dateOfBirth',
            DateType::class,
            [
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'input_format' => 'dd-MM-yyyy',
                'label' => 'label.dateOfBirth_req',
                'required' => true,
            ]
        );

        $builder->add(
            'dateOfDeath',
            DateType::class,
            [
                'widget' => 'single_text',
                'input_format' => 'dd-MM-yyyy',
                'input' => 'datetime_immutable',
                'label' => 'label.dateOfDeath',
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
                'placeholder' => 'label.name',
                'required' => false,
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
