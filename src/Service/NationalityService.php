<?php
/**
 * Nationality service.
 */

namespace App\Service;

use App\Entity\Nationality;
use App\Repository\NationalityRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class NationalityService.
 */
class NationalityService implements NationalityServiceInterface
{
    /**
     * Nationality repository.
     */
    private NationalityRepository $nationalityRepository;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Constructor.
     *
     * @param NationalityRepository $nationalityRepository Nationality repository
     * @param PaginatorInterface    $paginator             Paginator
     */
    public function __construct(NationalityRepository $nationalityRepository, PaginatorInterface $paginator)
    {
        $this->nationalityRepository = $nationalityRepository;
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
            $this->nationalityRepository->queryAll(),
            $page,
            NationalityRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Save entity.
     *
     * @param Nationality $nationality Nationality entity
     */
    public function save(Nationality $nationality): void
    {
        $this->nationalityRepository->save($nationality);
    }

    /**
     * Delete entity.
     *
     * @param Nationality $nationality Nationality entity
     */
    public function delete(Nationality $nationality): void
    {
        $this->nationalityRepository->delete($nationality);
    }
}
