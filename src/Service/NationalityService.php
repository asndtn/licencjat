<?php
/**
 * Nationality service.
 */

namespace App\Service;

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

    public function __construct(NationalityRepository $nationalityRepository, PaginatorInterface $paginator)
    {
        $this->nationalityRepository = $nationalityRepository;
        $this->paginator = $paginator;
    }

    public function getPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->nationalityRepository->queryAll(),
            $page,
            NationalityRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }
}
