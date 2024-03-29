<?php
/**
 * Artist entity.
 */

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Artist.
 *
 * @ORM\Entity(repositoryClass="App\Repository\ArtistRepository")
 * @ORM\Table("artists")
 *
 * @UniqueEntity(fields={"name"})
 *
 * @psalm-suppress MissingConstructor
 */
class Artist
{
    /**
     * Primary key.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * Name.
     *
     * @var string|null Name
     *
     * @ORM\Column(type="string", length=64)
     *
     * @Assert\Type("string")
     * @Assert\NotBlank
     * @Assert\Length(min="3", max="64")
     */
    private ?string $name;

    /**
     * DateOfBirth.
     *
     * @var DateTimeImmutable|null DateOfBirth
     *
     * @ORM\Column(type="datetime_immutable")
     *
     * @Assert\Type("DateTimeImmutable")
     */
    private ?DateTimeImmutable $dateOfBirth;

    /**
     * DateOfDeath.
     *
     * @var DateTimeImmutable|null DateOfDeath
     *
     * @ORM\Column(type="datetime_immutable", nullable=true)
     *
     * @Assert\Type("DateTimeImmutable")
     */
    private ?DateTimeImmutable $dateOfDeath = null;

    /**
     * Nationality.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Nationality", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(nullable=true)
     */
    private ?Nationality $nationality;

    /**
     * Artist's photo filename.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $photoFilename;

    /**
     * Artwork.
     *
     * @var array
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Artwork", mappedBy="artist")
     */
    private $artwork;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->artwork = new ArrayCollection();
    }

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

    /**
     * Getter for DateOfBirth.
     *
     * @return DateTimeImmutable|null DateOfBirth
     */
    public function getDateOfBirth(): ?DateTimeImmutable
    {
        return $this->dateOfBirth;
    }

    /**
     * Setter for DateOfBirth.
     *
     * @param DateTimeImmutable|null $dateOfBirth DateOfBirth
     */
    public function setDateOfBirth(?DateTimeImmutable $dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * Getter for DateOfDeath.
     *
     * @return DateTimeImmutable|null DateOfDeath
     */
    public function getDateOfDeath(): ?DateTimeImmutable
    {
        return $this->dateOfDeath;
    }

    /**
     * Setter for DateOfDeath.
     *
     * @param DateTimeImmutable|null $dateOfDeath DateOfDeath
     */
    public function setDateOfDeath(?DateTimeImmutable $dateOfDeath): void
    {
        $this->dateOfDeath = $dateOfDeath;
    }

    /**
     * Getter for Nationality.
     *
     * @return Nationality|null Nationality
     */
    public function getNationality(): ?Nationality
    {
        return $this->nationality;
    }

    /**
     * Setter for Nationality.
     *
     * @param Nationality|null $nationality Nationality
     */
    public function setNationality(?Nationality $nationality): void
    {
        $this->nationality = $nationality;
    }

    /**
     * Getter for Photo filename.
     *
     * @return string|null Photo filename
     */
    public function getPhotoFilename(): ?string
    {
        return $this->photoFilename;
    }

    /**
     * Setter for Photo Filename.
     *
     * @param string|null $photoFilename Photo filename
     */
    public function setPhotoFilename(?string $photoFilename): void
    {
        $this->photoFilename = $photoFilename;
    }

    /**
     * Getter for Artwork.
     *
     * @return Collection<int, Artwork> Artwork collection.
     */
    public function getArtwork(): Collection
    {
        return $this->artwork;
    }

    /**
     * Add artwork.
     *
     * @param Artwork $artwork Artwork entity
     */
    public function addArtwork(Artwork $artwork): void
    {
        if (!$this->artwork->contains($artwork)) {
            $this->artwork[] = $artwork;
        }
    }

    /**
     * Remove artwork.
     *
     * @param Artwork $artwork Artwork entity
     */
    public function removeArtwork(Artwork $artwork): void
    {
        $this->artwork->removeElement($artwork);
    }
}
