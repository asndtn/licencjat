<?php
/**
 * Input entity.
 */

namespace App\Entity;

use App\Repository\InputRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Input.
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
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 64)]
    private ?string $title = null;

    /**
     * Description.
     *
     * @var string|null
     */
    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    private ?string $description = null;

    /**
     * Category.
     *
     * @var Category
     */
    #[ORM\ManyToOne(targetEntity: Category::class, fetch: 'EXTRA_LAZY')]
    #[Assert\Type(Category::class)]
    #[Assert\NotBlank]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    /**
     * Field.
     *
     * @var Field
     */
    #[ORM\ManyToOne(targetEntity: Field::class, fetch: 'EXTRA_LAZY')]
    #[Assert\Type(Field::class)]
    #[Assert\NotBlank]
    #[ORM\JoinColumn(nullable: false)]
    private ?Field $field = null;

    /**
     * Movement.
     *
     * @var Movement
     */
    #[ORM\ManyToOne(targetEntity: Movement::class, fetch: 'EXTRA_LAZY')]
    #[Assert\Type(Movement::class)]
    #[Assert\NotBlank]
    #[ORM\JoinColumn(nullable: false)]
    private ?Movement $movement = null;

    /**
     * Artist.
     *
     * @var Artist
     */
    #[ORM\ManyToOne(targetEntity: Artist::class, fetch: 'EXTRA_LAZY')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Artist $artist = null;

    /**
     * Tags.
     *
     * @var ArrayCollection<int, Tag>
     */
    #[Assert\Valid]
    #[ORM\ManyToMany(targetEntity: Tag::class, fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    #[ORM\JoinTable(name: 'inputs_tags')]
    private $tags;

    #[ORM\ManyToOne(targetEntity: User::class, fetch: 'EXTRA_LAZY')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    #[Assert\Type(User::class)]
    private $author;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
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

    /**
     * Getter for Artist.
     *
     * @return Artist|null Artist
     */
    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    /**
     * Setter for Artist.
     *
     * @param Artist|null $artist Artist
     */
    public function setArtist(?Artist $artist): void
    {
        $this->artist = $artist;
    }

    /**
     * Getter for tags.
     *
     * @return Collection<int, Tag> Tags collection
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * Add tag.
     *
     * @param Tag $tag Tag entity
     */
    public function addTag(Tag $tag): void
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }
    }

    /**
     * Remove tag.
     *
     * @param Tag $tag Tag entity
     */
    public function removeTag(Tag $tag): void
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Getter for Author.
     *
     * @return User|null User
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * Setter for Author.
     *
     * @param User|null $author User
     */
    public function setAuthor(?User $author): void
    {
        $this->author = $author;
    }
}
