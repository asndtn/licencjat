<?php
/**
 * Artist entity.
 */

namespace App\Entity;

use App\Repository\ArtistRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Artist.
 *
 * @psalm-suppress MissingConstructor
 */
#[ORM\Entity(repositoryClass: ArtistRepository::class)]
#[ORM\Table(name: 'artists')]
#[ORM\UniqueConstraint(name: 'uq_artists_name', columns: ['name'])]
#[UniqueEntity(fields: ['name'])]
class Artist
{
    /**
     * Primary key.
     *
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * Name.
     *
     * @var string|null Name
     */
    #[ORM\Column(type: 'string', length: 64)]
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 64)]
    private ?string $name;

    /**
     * DateOfBirth.
     *
     * @var DateTimeImmutable|null DateOfBirth
     */
    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\Type(DateTimeImmutable::class)]
    private ?DateTimeImmutable $dateOfBirth;

    /**
     * DateOfDeath.
     *
     * @var DateTimeImmutable|null DateOfDeath
     */
    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    #[Assert\Type(DateTimeImmutable::class)]
    private ?DateTimeImmutable $dateOfDeath = null;

    /**
     * Nationality.
     *
     * @var Nationality
     */
    #[ORM\ManyToOne(targetEntity: Nationality::class, fetch: 'EXTRA_LAZY')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Nationality $nationality = null;

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
}
