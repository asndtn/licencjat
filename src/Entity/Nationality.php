<?php
/**
 * Nationality entity.
 */

namespace App\Entity;

use App\Repository\NationalityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Nationality.
 *
 * @psalm-suppress MissingConstructor
 */
#[ORM\Entity(repositoryClass: NationalityRepository::class)]
#[ORM\Table(name: 'nationalities')]
#[ORM\UniqueConstraint(name: 'uq_nationalities_name', columns: ['name'])]
#[UniqueEntity(fields: ['name'])]
class Nationality
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
     * @var string|null
     */
    #[ORM\Column(type: 'string', length: 64)]
    private ?string $name;

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
}
