<?php
/**
 * Artwork entity.
 */

namespace App\Entity;

use App\Repository\ArtworkRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Artwork.
 *
 * @ORM\Entity(repositoryClass="App\Repository\ArtworkRepository")
 * @ORM\Table("artworks")
 *
 * @UniqueEntity(fields={"artworkFilename"})
 *
 * @psalm-suppress MissingConstructor
 */
class Artwork
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
     * Artwork filename.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $artworkFilename;

    /**
     * Artist.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Artist", inversedBy="artwork")
     * @ORM\JoinColumn(name="artist_id", referencedColumnName="id")
     */
    private ?Artist $artist;

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
     * Getter for Artwork filename.
     *
     * @return string|null Artwork Filename
     */
    public function getArtworkFilename(): ?string
    {
        return $this->artworkFilename;
    }

    /**
     * Setter for Artwork filename.
     *
     * @param string|null $artworkFilename Artwork filename
     */
    public function setArtworkFilename(?string $artworkFilename): void
    {
        $this->artworkFilename = $artworkFilename;
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
}
