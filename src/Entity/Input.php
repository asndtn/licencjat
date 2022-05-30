<?php
/**
 * Input entity.
 */

namespace App\Entity;

use App\Repository\InputRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Input.
 *
 * @psalm-suppress MissingConstructor
 */
#[ORM\Entity(repositoryClass: InputRepository::class)]
#[ORM\Table(name: 'inputs')]
class Input
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
     * User.
     *
     * @var int|null
     */
    #[ORM\Column(type: 'integer')]
    private ?int $user = null;

    /**
     * Artist.
     *
     * @var int|null
     */
    #[ORM\Column(type: 'integer')]
    private ?int $artist = null;

    /**
     * Category.
     *
     * @var int|null
     */
    #[ORM\Column(type: 'integer')]
    private ?int $category = null;

    /**
     * Field.
     *
     * @var int|null
     */
    #[ORM\Column(type: 'integer')]
    private ?int $field = null;

    /**
     * Movement.
     *
     * @var int|null
     */
    #[ORM\Column(type: 'integer')]
    private ?int $movement = null;

    /**
     * Title.
     *
     * @var string|null
     */
    #[ORM\Column(type: 'string', length: 180)]
    private ?string $title = null;

    /**
     * Description.
     *
     * @var string|null
     */
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $description = null;

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
     * Getter for User.
     *
     * @return int|null User
     */
    public function getUser(): ?int
    {
        return $this->user;
    }

    /**
     * Setter for User.
     *
     * @param int|null $user User
     */
    public function setUser(?int $user): void
    {
        $this->user = $user;
    }

    /**
     * Getter for Artist.
     *
     * @return int|null Artist
     */
    public function getArtist(): ?int
    {
        return $this->artist;
    }

    /**
     * Setter for Artist.
     *
     * @param int|null $artist Artist
     */
    public function setArtist(?int $artist): void
    {
        $this->artist = $artist;
    }

    /**
     * Getter for Category.
     *
     * @return int|null Category
     */
    public function getCategory(): ?int
    {
        return $this->category;
    }

    /**
     * Setter for Category.
     *
     * @param int|null $category Category
     */
    public function setCategory(?int $category): void
    {
        $this->category = $category;
    }

    /**
     * Getter for Field.
     *
     * @return int|null Field
     */
    public function getField(): ?int
    {
        return $this->field;
    }


    /**
     * Setter for Field.
     *
     * @param int|null $field Field
     */
    public function setField(?int $field): void
    {
        $this->field = $field;
    }

    /**
     * Getter for Movement.
     *
     * @return int|null Movement
     */
    public function getMovement(): ?int
    {
        return $this->movement;
    }

    /**
     * Setter for Movement.
     *
     * @param int|null $movement Movement
     */
    public function setMovement(?int $movement): void
    {
        $this->movement = $movement;
    }

    /**
     * Getter for Title.
     *
     * @return string|null Title
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Setter for Title.
     *
     * @param string|null $title Title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * Getter for Description.
     *
     * @return string|null Description
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Setter for Description.
     *
     * @param string|null $description Description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
