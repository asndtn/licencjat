<?php
/**
 * Movement service.
 */

namespace App\Service;

use App\Repository\MovementRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class MovementService.
 */
class MovementService implements MovementServiceInterface
{
    /**
     * Movement repository.
     */
    private MovementRepository $movementRepository;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    public function __construct(MovementRepository $movementRepository, PaginatorInterface $paginator)
    {
        $this->movementRepository = $movementRepository;
        $this->paginator = $paginator;
    }

    public function getPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->movementRepository->queryAll(),
            $page,
            MovementRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }
}
