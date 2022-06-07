<?php
/**
 * Artist service.
 */

namespace App\Service;

use App\Entity\Artist;
use App\Repository\ArtistRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class ArtistService.
 */
class ArtistService implements ArtistServiceInterface
{
    /**
     * Artist repository.
     */
    private ArtistRepository $artistRepository;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Constructor.
     *
     * @param ArtistRepository   $artistRepository Artist repository
     * @param PaginatorInterface $paginator        Paginator
     */
    public function __construct(ArtistRepository $artistRepository, PaginatorInterface $paginator)
    {
        $this->artistRepository = $artistRepository;
        $this->paginator = $paginator;
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
            $this->artistRepository->queryAll(),
            $page,
            ArtistRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Save entity.
     *
     * @param Artist $artist Artist entity
     */
    public function save(Artist $artist): void
    {
        $this->artistRepository->save($artist);
    }

    /**
     * Delete entity.
     *
     * @param Artist $artist Artist entity
     */
    public function delete(Artist $artist): void
    {
        $this->artistRepository->delete($artist);
    }
}
