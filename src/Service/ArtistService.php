<?php
/**
 * Artist service.
 */

namespace App\Service;

use App\Entity\Artist;
use App\Repository\ArtistRepository;
use App\Repository\InputRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
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
     * InputRepository.
     */
    private InputRepository $inputRepository;

    /**
     * Constructor.
     *
     * @param ArtistRepository   $artistRepository Artist repository
     * @param PaginatorInterface $paginator        Paginator
     */
    public function __construct(ArtistRepository $artistRepository, InputRepository $inputRepository, PaginatorInterface $paginator)
    {
        $this->artistRepository = $artistRepository;
        $this->paginator = $paginator;

        $this->inputRepository = $inputRepository;
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
     * Can Artist be deleted?
     *
     * @param Artist $artist Artist entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Artist $artist): bool
    {
        try {
            $result = $this->inputRepository->countByArtist($artist);

            return !($result > 0);
        } catch (NoResultException|NonUniqueResultException $ex) {
            return false;
        }
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
