<?php
/**
 * Artwork service.
 */

namespace App\Service;

use App\Entity\Artwork;
use App\Repository\ArtistRepository;
use App\Repository\ArtworkRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class ArtworkService.
 */
class ArtworkService implements ArtworkServiceInterface
{
    /**
     * Artwork repository.
     */
    private ArtworkRepository $artworkRepository;

    /**
     * ArtistRepository.
     */
    private ArtistRepository $artistRepository;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Constructor.
     *
     * @param ArtworkRepository      $artworkRepository   Artwork repository
     * @param ArtistRepository    $artistRepository Artist repository
     * @param PaginatorInterface $paginator       Paginator
     */
    public function __construct(ArtworkRepository $artworkRepository, ArtistRepository $artistRepository, PaginatorInterface $paginator)
    {
        $this->artworkRepository = $artworkRepository;
        $this->paginator = $paginator;

        $this->artistRepository = $artistRepository;
    }

    /**
     * Get paginated list.
     *
     * @param int $page Page number
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->artworkRepository->queryAll(),
            $page,
            ArtworkRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Find by filename.
     *
     * @param string $artworkFilename Artwork name
     *
     * @return Artwork|null Artwork entity
     */
    public function findOneByName(string $artworkFilename): ?Artwork
    {
        return $this->artworkRepository->findOneByArtworkFilename($artworkFilename);
    }
    /**
     * Save entity.
     *
     * @param Artwork $artwork Artwork entity
     */
    public function save(Artwork $artwork): void
    {
        $this->artworkRepository->save($artwork);
    }

    /**
     * Delete entity.
     *
     * @param Artwork $artwork Artwork entity
     */
    public function delete(Artwork $artwork): void
    {
        $this->artworkRepository->delete($artwork);
    }
}
