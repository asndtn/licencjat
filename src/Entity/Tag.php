<?php
/**
 * Tag entity.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Mapping\Annotation\Slug;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Tag.
 *
 * @psalm-suppress MissingConstructor
 *
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 * @ORM\Table(name="tags")
 *
 * @UniqueEntity(fields={"name"})
 */
class Tag
{
    /**
     * Primary key.
     *
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Name.
     *
     * @ORM\Column(type="string", length=64)
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @Assert\Length(min=3, max=64)
     */
    private ?string $name;

//    /**
//     * Slug.
//     *
//     * @var string|null
//     *
//     * @ORM\Column(type="string", length=64)
//     *
//     * @Assert\Type(type="string")
//     * @Assert\Length(min=3, max=64)
//     *
//     * @Gedmo\Slug(fields="name")
//     */
//    private ?string $slug;

    /**
     * Getter for Id.
     *
     * @return int|null Id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for Name.
     *
     * @return string|null Name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Setter for Name.
     *
     * @param string|null $name Name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

//    /**
//     * Getter for Slug.
//     *
//     * @return string|null Slug
//     */
//    public function getSlug(): ?string
//    {
//        return $this->slug;
//    }
//
//    /**
//     * Setter for Slug.
//     *
//     * @param string $slug Slug
//     */
//    public function setSlug(string $slug): void
//    {
//        $this->slug = $slug;
//    }
}
