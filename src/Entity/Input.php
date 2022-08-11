<?php
/**
 * Input entity.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Input.
 *
 * @ORM\Entity(repositoryClass="App\Repository\InputRepository")
 * @ORM\Table(name="inputs")
 */
class Input
{
    /**
     * Primary key.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * Title.
     *
     * @ORM\Column(type="string", length=180)
     *
     * @Assert\Type("string")
     * @Assert\NotBlank
     * @Assert\Length(
     *     min=3,
     *     max=180
     * )
     */
    private string $title;

    /**
     * Category.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", fetch="EXTRA_LAZY")
     *
     * @Assert\Type("App\Entity\Category")
     * @Assert\NotBlank
     *
     * @ORM\JoinColumn(nullable=false)
     */
    private Category $category;

    /**
     * Field.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Field", fetch="EXTRA_LAZY")
     *
     * @Assert\Type("App\Entity\Field")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private ?Field $field = null;

    /**
     * Movement.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Movement", fetch="EXTRA_LAZY")
     *
     * @Assert\Type("App\Entity\Movement")
     *
     * @ORM\JoinColumn(nullable=true)
     */
    private ?Movement $movement = null;

    /**
     * Artist.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Artist", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\Type(type="App\Entity\Artist")
     */
    private Artist $artist;

    /**
     * Tags.
     *
     * @var array
     *
     * @Assert\Valid
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", fetch="EXTRA_LAZY", orphanRemoval=true)
     * @ORM\JoinTable(name="inputs_tags")
     */
    private $tags;

    /**
     * Author.
     *
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", fetch="EXTRA_LAZY")
     *
     * @Assert\NotBlank
     * @Assert\Type("App\Entity\User")
     *
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * Description.
     *
     * @ORM\Column(type="string", nullable=false, length=2048)
     *
     * @Assert\Type("string")
     * @Assert\NotBlank
     * @Assert\Length(
     *     min="3",
     *     max="2048",
     * )
     */
    private ?string $description = null;

    /**
     * Painting filename.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $paintingFilename;

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
     * @return int Id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Getter for Title.
     *
     * @return string Title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Setter for Title.
     *
     * @param string $title Title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Getter for Category.
     *
     * @return Category Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * Setter for Category.
     *
     * @param Category $category Category
     */
    public function setCategory(Category $category): void
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
     * @return Artist Artist
     */
    public function getArtist(): Artist
    {
        return $this->artist;
    }

    /**
     * Setter for Artist.
     *
     * @param Artist $artist Artist
     */
    public function setArtist(Artist $artist): void
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
     * @return User User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * Setter for Author.
     *
     * @param User $author User
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
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
     * Getter for Painting filename.
     *
     * @return string|null Painting filename
     */
    public function getPaintingFilename(): ?string
    {
        return $this->paintingFilename;
    }

    /**
     * Setter for Painting filename.
     *
     * @param string|null $paintingFilename Painting filename
     */
    public function setPaintingFilename(?string $paintingFilename): void
    {
        $this->paintingFilename = $paintingFilename;
    }
}
