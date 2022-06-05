<?php
/**
 * Artist service.
 */

namespace App\Service;

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
     *
     * @var ArtistRepository
     */
    private ArtistRepository $artistRepository;

    /**
     * Paginator.
     *
     * @var PaginatorInterface
     */
    private PaginatorInterface $paginator;

    public function __construct(ArtistRepository $artistRepository, PaginatorInterface $paginator)
    {
        $this->artistRepository = $artistRepository;
        $this->paginator = $paginator;
    }

    public function getPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->artistRepository->queryAll(),
            $page,
            ArtistRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }
}
