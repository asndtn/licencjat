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
     * Category.
     *
     * @var Category|null
     */
    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    /**
     * Field.
     *
     * @var Field|null
     */
    #[ORM\ManyToOne(targetEntity: Field::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Field $field = null;

    /**
     * Movement.
     *
     * @var Movement|null
     */
    #[ORM\ManyToOne(targetEntity: Movement::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Movement $movement = null;

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

    /**
     * Getter for Category.
     *
     * @return Category|null Category
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * Setter for Category.
     *
     * @param Category|null $category Category
     */
    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }

    /**
     * Getter for Field.
     *
     * @return Field|null Field
     */
    public function getField(): ?Field
    {
        return $this->field;
    }

    /**
     * Setter for Field.
     *
     * @param Field|null $field Field
     */
    public function setField(?Field $field): void
    {
        $this->field = $field;
    }

    /**
     * Getter for Movement.
     *
     * @return Movement|null Movement
     */
    public function getMovement(): ?Movement
    {
        return $this->movement;
    }

    /**
     * Setter for Movement.
     *
     * @param Movement|null $movement Movement
     */
    public function setMovement(?Movement $movement): void
    {
        $this->movement = $movement;
    }
}
